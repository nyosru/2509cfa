<div class="container mx-auto px-4 py-8"
     x-data="{
         scrollToContent() {
             // Находим элемент контента и прокручиваем к нему
             const contentElement = document.getElementById('content-block');
             if (contentElement) {
                 const offsetTop = contentElement.offsetTop - 150;
                 window.scrollTo({
                     top: offsetTop,
                     behavior: 'smooth'
                 });
             }
         }
     }"
     @scroll-to-content.window="scrollToContent()">

    <!-- Заголовок -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">База знаний по&nbsp;финансовому анализу и&nbsp;управлению</h1>
        {{--        <p class="text-gray-600"></p>--}}
    </div>

    <!-- Индикатор загрузки -->
    @if($isLoading)
        <div class="fixed inset-0 bg-white bg-opacity-80 flex items-center justify-center z-50">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500"></div>
        </div>
    @endif

    <!-- Поиск и управление -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center">
            <!-- Поиск -->
            <div class="w-full sm:w-96">
                <input
                    type="text"
                    wire:model.live="search"
                    placeholder="Поиск по заголовкам и содержанию..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    @if($isLoading) disabled @endif
                >
            </div>

            <!-- Информация -->
            @if(!$selectedParentId)
                <div class="text-sm text-gray-600">
                    Найдено: {{ $parents->total() }} записей
                </div>
            @endif
        </div>
    </div>

    <!-- Хлебные крошки -->
    @if($selectedParentId && $selectedParent)
        <div class="mb-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <button
                            wire:click="backToList"
                            class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 cursor-pointer"
                            @if($isLoading) disabled @endif
                        >
                            Все разделы
                        </button>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">
                                {{ $selectedParent->title }}
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    @endif

    <!-- Блок контента с ID для прокрутки -->
    <div id="content-block" class="bg-white rounded-lg shadow-lg overflow-hidden">
        @if($selectedParentId && $selectedParent)
            <!-- Детальный вид родителя с детьми -->
            <div class="p-6">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $selectedParent->title }}</h2>
                    <div class="prose max-w-none text-gray-700">
                        {{--                        {!! nl2br(e($selectedParent->content)) !!}--}}
                        {!! $selectedParent->content !!}
                    </div>
                </div>

                @if($selectedParent->activeChildren->count() > 0)
                    <div class="border-t pt-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Подразделы:</h3>
                        <div class="space-y-4">
                            @foreach($selectedParent->activeChildren as $child)
                                <div class="border-l-4 border-blue-500 bg-blue-50 p-4 rounded-r-lg">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $child->title }}</h4>
                                    <p class="text-gray-700">{!! nl2br(e($child->content)) !!}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        Нет подразделов для этого раздела
                    </div>
                @endif
            </div>

        @elseif($selectedParentId && !$selectedParent)
            <!-- Сообщение, если родитель не найден -->
            <div class="p-6 text-center">
                <div class="text-yellow-600 mb-4">
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <p class="text-gray-600 mb-4">Раздел не найден или был удален</p>
                <button
                    wire:click="backToList"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
                >
                    Вернуться к списку
                </button>
            </div>

        @else
            <!-- Список родителей -->
            <div class="divide-y divide-gray-200">
                @forelse($parents as $parent)
                    <div class="p-6 hover:bg-gray-50 transition-colors cursor-pointer"
                         wire:click="selectParent({{ $parent->id }})"
                         wire:key="parent-{{ $parent->id }}"
                         @if($isLoading) style="pointer-events: none; opacity: 0.6;" @endif>
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $parent->title }}</h3>
                                <p class="text-gray-600 line-clamp-2 mb-3">{{ \Illuminate\Support\Str::limit($parent->content, 150) }}</p>

                                @if($parent->active_children_count > 0)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $parent->active_children_count }} подразделов
                                    </span>
                                @endif
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-gray-500">
                        @if($search)
                            По запросу "{{ $search }}" ничего не найдено
                        @else
                            Нет доступных разделов
                        @endif
                    </div>
                @endforelse
            </div>

            <!-- Пагинация -->
            @if($parents->hasPages())
                <div class="px-6 py-4 border-t">
                    {{ $parents->links() }}
                </div>
            @endif
        @endif
    </div>

    <!-- Alpine.js скрипт для обработки начальной прокрутки -->
    <script>
        // Прокрутка при загрузке страницы с выбранным родителем
        document.addEventListener('livewire:init', () => {
            @if($selectedParentId && $selectedParent)
            // Ждем полной загрузки компонента
            setTimeout(() => {
                const contentElement = document.getElementById('content-block');
                if (contentElement) {
                    const offsetTop = contentElement.offsetTop - 150;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            }, 300);
            @endif
        });

        // Обработка кнопок браузера "назад/вперед"
        window.addEventListener('popstate', function () {
            setTimeout(() => {
                const contentElement = document.getElementById('content-block');
                if (contentElement) {
                    const offsetTop = contentElement.offsetTop - 150;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            }, 100);
        });
    </script>
</div>
