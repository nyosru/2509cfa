<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="save">
        <div>
            <label>Заголовок</label>
            <input type="text" wire:model.defer="title">
            @error('title') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Контент</label>
            <textarea wire:model.defer="content"></textarea>
            @error('content') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Родитель</label>
            <select wire:model.defer="parent_id">
                <option value="">Выберите родителя</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent['id'] }}">{{ $parent['name'] ?? $parent['title'] ?? 'Родитель #'.$parent['id'] }}</option>
                @endforeach
            </select>
            @error('parent_id') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Порядок</label>
            <input type="number" min="0" wire:model.defer="order">
            @error('order') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>
                <input type="checkbox" wire:model.defer="is_active">
                Активен
            </label>
            @error('is_active') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Создать</button>
    </form>
</div>
