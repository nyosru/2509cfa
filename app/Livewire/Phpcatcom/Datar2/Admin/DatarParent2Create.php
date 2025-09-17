<?php

namespace App\Livewire\Phpcatcom\Datar2\Admin;

use App\Models\Datar2;
use App\Models\DatarParent;
use Livewire\Component;

class DatarParent2Create extends Component
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
//            'parent_id' => 'required|exists:datar_parents,id',
            'parent_id' => 'nullable|exists:datar_parents,id',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ];
    }

    public function mount()
    {
        // Загрузить доступные родители для выбора
        $this->parents = DatarParent::orderBy('title')->get()->toArray();
    }

    public function save()
    {
        $this->validate();

        $this->content = nl2br($this->content);

        if( !empty($this->parent_id) ) {
            Datar2::create([
                'title' => $this->title,
                'content' => $this->content,
                'parent_id' => $this->parent_id,
                'order' => $this->order,
                'is_active' => $this->is_active,
            ]);
        }else{
            DatarParent::create([
                'title' => $this->title,
                'content' => $this->content,
                'order' => $this->order,
                'is_active' => $this->is_active,
            ]);
        }

        // Очистить форму после сохранения
        $this->reset(['title', 'content', 'parent_id', 'order', 'is_active']);

        session()->flash('message', 'Запись успешно создана.');
    }


    public function render()
    {
        return view('livewire.phpcatcom.datar2.admin.datar-parent2-create');
    }
}
