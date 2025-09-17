<?php

namespace App\Livewire\Phpcatcom\Datar2\Admin;

use App\Models\DatarParent;
use Livewire\Component;

class DatarParentEdit extends Component
{
    public $parent;
    public $title;
    public $content;
    public $order;
    public $is_active;

    protected $rules = [
        'title' => 'required|string|min:3|max:255',
        'content' => 'required|string|min:10',
        'order' => 'required|integer|min:0',
        'is_active' => 'boolean'
    ];

    public function mount($id)
    {
        $this->parent = DatarParent::findOrFail($id);
        $this->title = $this->parent->title;
        $this->content = $this->parent->content;
        $this->order = $this->parent->order;
        $this->is_active = $this->parent->is_active;
    }

    public function save()
    {
        $this->validate();

        $this->parent->update([
            'title' => $this->title,
            'content' => $this->content,
            'order' => $this->order,
            'is_active' => $this->is_active
        ]);

        session()->flash('success', 'Родительский элемент успешно обновлен!');
        return redirect()->route('datar2.admin');
    }

    public function cancel()
    {
        return redirect()->route('datar2.admin');
    }

    public function render()
    {
        return view('livewire.phpcatcom.datar2.admin.datar-parent-edit', [
            'parentItem' => $this->parent
        ]);
    }
}
