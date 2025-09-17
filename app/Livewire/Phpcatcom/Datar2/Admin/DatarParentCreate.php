<?php

namespace Phpcatcom\Datar2\Admin;

use Livewire\Component;
use App\Models\Datar2;
use App\Models\DatarParent;

class DatarParentCreate extends Component
{
    public string $title = '';
    public string $content = '';
    public ?int $parent_id = null;
    public int $order = 0;
    public bool $is_active = true;

    public array $parents = [];

    protected function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'parent_id' => 'required|exists:datar_parents,id',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ];
    }

    public function mount()
    {
        // Загрузить доступные родители для выбора
        $this->parents = DatarParent::orderBy('name')->get()->toArray();
    }

    public function save()
    {
        $this->validate();

        Datar2::create([
            'title' => $this->title,
            'content' => $this->content,
            'parent_id' => $this->parent_id,
            'order' => $this->order,
            'is_active' => $this->is_active,
        ]);

        // Очистить форму после сохранения
        $this->reset(['title', 'content', 'parent_id', 'order', 'is_active']);

        session()->flash('message', 'Запись успешно создана.');
    }

    public function render()
    {
        return view('phpcatcom.datar2.admin.datar-parent-create');
    }
}
