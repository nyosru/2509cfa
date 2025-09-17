<div class="container mx-auto px-4 py-8 max-w-4xl">
    <!-- Кнопка назад -->
    <div class="mb-6">
        <a
            href="{{ route('news.index') }}"
            class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium"
        >
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Назад к списку новостей
        </a>
    </div>

    @if($newsItem)
        <!-- Заголовок -->
        <article>
            <header class="mb-8">
                <div class="flex items-center text-sm text-gray-500 mb-4">
                    <time datetime="{{ $newsItem->published_at->format('Y-m-d') }}">
                        {{ $newsItem->published_at->translatedFormat('d F Y') }}
                    </time>
                    <span class="mx-2">•</span>
                    <span>{{ $newsItem->views }} просмотров</span>
                </div>

                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                    {{ $newsItem->title }}
                </h1>

                @if($newsItem->image)
                    <img
                        src="{{ asset('storage/' . $newsItem->image) }}"
                        alt="{{ $newsItem->title }}"
                        class="w-full h-64 md:h-96 object-cover rounded-lg shadow-md mb-6"
                    >
                @endif
            </header>

            <!-- Контент -->
            <div class="prose prose-lg max-w-none text-gray-700 mb-8">
                {!! nl2br(e($newsItem->content)) !!}
            </div>

            <!-- Дополнительная информация -->
            <footer class="border-t pt-6">
                <div class="flex items-center justify-between text-sm text-gray-500">
                    <span>Опубликовано: {{ $newsItem->published_at->diffForHumans() }}</span>
                    <span>Просмотров: {{ $newsItem->views }}</span>
                </div>
            </footer>
        </article>
    @else
        <div class="text-center py-12">
            <svg class="w-16 h-16 text-yellow-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Новость не найдена</h2>
            <p class="text-gray-600 mb-6">Запрошенная новость не существует или была удалена</p>
            <a
                href="{{ route('news.index') }}"
                class="inline-flex items-center px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
            >
                Вернуться к списку новостей
            </a>
        </div>
    @endif
</div>
