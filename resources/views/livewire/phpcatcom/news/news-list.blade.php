<div class="container mx-auto px-4 py-8">

    <!-- Заголовок -->
    <div class="mb-8 text-center">
        <a
            href="{{ route('news.index') }}"
        >
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Новости финансового анализа</h1>
        </a>
        <p class="text-gray-600 text-lg">Актуальные события и новости из мира финансовой аналитики</p>
    </div>

    @if( $view == 'start' )
    @else
        <!-- Поиск -->
        <div class="mb-8">
            <div class="max-w-2xl mx-auto">
                <input
                    type="text"
                    wire:model.live="search"
                    placeholder="Поиск новостей..."
                    class="w-full px-6 py-3 border border-gray-300 rounded-full focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm"
                >
            </div>
        </div>
    @endif


    <!-- Список новостей -->
    @if($news->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($news as $item)
                <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">


                    @if($item->image)
                        <img
                            src="{{ asset('storage/' . $item->image) }}"
                            alt="{{ $item->title }}"
                            class="w-full h-48 object-cover"
                        >
                    @else
                        <div
                            class="w-full h-48 bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                    @endif

                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <time datetime="{{ $item->published_at->format('Y-m-d') }}">
                                {{ $item->published_at->locale('ru')->translatedFormat('d F Y') }}
                            </time>
                            <span class="mx-2">•</span>
                            <span>{{ $item->views }} просмотров</span>
                        </div>

                        <a
                            href="{{ route('news.show', $item->slug) }}"
                            class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium"
                        >
                        <h2 class="text-xl font-semibold text-gray-900 mb-3 line-clamp-2">
                            {{ $item->title }}
                        </h2>
                        </a>


                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ $item->excerpt }}
                        </p>

                        <a
                            href="{{ route('news.show', $item->slug) }}"
                            class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium"
                        >
                            Читать далее
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        @if( $view == 'start' )
        @else

        <!-- Пагинация -->
        <div class="mt-8">
            {{ $news->links() }}
        </div>
        @endif
    @else
        <div class="text-center py-12">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-gray-600 text-lg">
                @if($search)
                    По запросу "{{ $search }}" новостей не найдено
                @else
                    Новостей пока нет
                @endif
            </p>
        </div>
    @endif
</div>
