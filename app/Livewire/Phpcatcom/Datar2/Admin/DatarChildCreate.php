<?php

namespace App\Livewire\Phpcatcom\Datar2\Admin;

use App\Models\Datar2;
use App\Models\DatarParent;
use Livewire\Component;

class DatarChildCreate extends Component
{
    public $title;
    public $content;
    public $parent_id;
    public $order = 0;
    public $is_active = true;
    public $parents = [];

    protected $rules = [
        'title' => 'required|string|min:3|max:255',
        'content' => 'required|string|min:10',
        'parent_id' => 'required|exists:datar_parents,id',
        'order' => 'required|integer|min:0',
        'is_active' => 'boolean'
    ];

    public function mount()
    {
        $this->parents = DatarParent::active()
            ->orderBy('order')
            ->orderBy('title')
            ->get();
    }

    public function save()
    {
        $this->validate();

        Datar2::create([
            'title' => $this->title,
            'content' => $this->content,
            'parent_id' => $this->parent_id,
            'order' => $this->order,
            'is_active' => $this->is_active
        ]);

        session()->flash('success', 'Дочерний элемент успешно создан!');
        return redirect()->route('datar2.admin', ['activeTab' => 'children']);
    }

    public function cancel()
    {
        return redirect()->route('datar2.admin');
    }

    public function render()
    {
        return view('livewire.phpcatcom.datar2.admin.datar-child-create');
    }
}
