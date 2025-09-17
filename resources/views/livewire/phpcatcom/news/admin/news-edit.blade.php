<div class="container mx-auto px-4 py-8 max-w-4xl">
    <!-- Заголовок -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Редактирование новости</h1>
        <p class="text-gray-600">Внесите изменения в новость</p>
    </div>

    <!-- Форма -->
    <form wire:submit="save" class="bg-white rounded-lg shadow-md p-6">
        <!-- Заголовок -->
        <div class="mb-6">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                Заголовок новости *
            </label>
            <input
                type="text"
                id="title"
                wire:model="title"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            >
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Краткое описание -->
        <div class="mb-6">
            <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">
                Краткое описание
            </label>
            <textarea
                id="excerpt"
                wire:model="excerpt"
                rows="3"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            ></textarea>
            @error('excerpt') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Содержание -->
        <div class="mb-6">
            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                Содержание новости *
            </label>
            <textarea
                id="content"
                wire:model="content"
                rows="10"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            ></textarea>
            @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Изображение -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Изображение
            </label>

            @if($currentImage)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $currentImage) }}" class="w-48 h-48 object-cover rounded">
                    <label class="flex items-center mt-2">
                        <input
                            type="checkbox"
                            wire:model="removeImage"
                            class="rounded border-gray-300 text-red-600 focus:ring-red-500"
                        >
                        <span class="ml-2 text-sm text-red-600">Удалить изображение</span>
                    </label>
                </div>
            @endif

            <input
                type="file"
                wire:model="image"
                accept="image/*"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg"
            >
            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            @if($image)
                <div class="mt-2">
                    <img src="{{ $image->temporaryUrl() }}" class="w-32 h-32 object-cover rounded">
                </div>
            @endif
        </div>

        <!-- Статус публикации -->
        <div class="mb-6">
            <label class="flex items-center">
                <input
                    type="checkbox"
                    wire:model="is_published"
                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                >
                <span class="ml-2 text-sm text-gray-700">Опубликовано</span>
            </label>
        </div>

        @if($is_published)
            <!-- Дата публикации -->
            <div class="mb-6">
                <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">
                    Дата и время публикации
                </label>
                <input
                    type="datetime-local"
                    id="published_at"
                    wire:model="published_at"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
                @error('published_at') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        @endif

        <!-- Кнопки -->
        <div class="flex justify-end space-x-4">
            <button
                type="button"
                wire:click="cancel"
                class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50"
            >
                Отмена
            </button>
            <button
                type="submit"
                class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
            >
                Обновить новость
            </button>
        </div>
    </form>
</div>
