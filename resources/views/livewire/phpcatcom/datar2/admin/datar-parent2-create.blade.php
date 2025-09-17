<form wire:submit.prevent="save" class="max-w-xl mx-auto p-6 bg-white rounded-lg shadow-md space-y-6">
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Заголовок</label>
        <input id="title" type="text" wire:model.defer="title"
               class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
        @error('title') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Контент</label>
        <textarea id="content" rows="4" wire:model.defer="content"
                  class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
        @error('content') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-1">Родитель</label>
        <select id="parent_id" wire:model.defer="parent_id"
                class="w-full rounded-md border border-gray-300 px-3 py-2 bg-white focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="">Выберите родителя</option>
            @foreach($parents as $parent)
                <option value="{{ $parent['id'] }}">{{ $parent['name'] ?? $parent['title'] ?? 'Родитель #' . $parent['id'] }}</option>
            @endforeach
        </select>
        @error('parent_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Порядок</label>
        <input id="order" type="number" min="0" wire:model.defer="order"
               class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
        @error('order') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="flex items-center space-x-2">
        <input id="is_active" type="checkbox" wire:model.defer="is_active"
               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
        <label for="is_active" class="text-sm font-medium text-gray-700">Активен</label>
        @error('is_active') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <button type="submit"
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        Создать
    </button>
</form>
