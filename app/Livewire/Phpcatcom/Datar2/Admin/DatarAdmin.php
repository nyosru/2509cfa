<?php

namespace App\Livewire\Phpcatcom\Datar2\Admin;

use App\Models\DatarParent;
use App\Models\Datar2;
use Livewire\Component;
use Livewire\WithPagination;

class DatarAdmin extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $activeTab = 'parents';
    public $selectedParent = null;
    public $confirmingDeletion = false;
    public $itemToDelete = null;
    public $deleteType = null; // 'parent' or 'child'

    protected $queryString = [
        'search' => ['except' => ''],
        'activeTab' => ['except' => 'parents'],
        'page' => ['except' => 1]
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function confirmDelete($type, $id)
    {
        $this->deleteType = $type;
        $this->itemToDelete = $id;
        $this->confirmingDeletion = true;
    }

    public function deleteItem()
    {
        if ($this->deleteType === 'parent') {
            $parent = DatarParent::find($this->itemToDelete);
            if ($parent) {
                // Удаляем всех детей перед удалением родителя
                $parent->children()->delete();
                $parent->delete();
            }
        } elseif ($this->deleteType === 'child') {
            $child = Datar2::find($this->itemToDelete);
            if ($child) {
                $child->delete();
            }
        }

        $this->confirmingDeletion = false;
        $this->itemToDelete = null;
        $this->deleteType = null;

        $this->dispatch('item-deleted');
    }

    public function toggleStatus($type, $id)
    {
        if ($type === 'parent') {
            $item = DatarParent::find($id);
        } else {
            $item = Datar2::find($id);
        }

        if ($item) {
            $item->update(['is_active' => !$item->is_active]);
            $this->dispatch('item-updated');
        }
    }

    public function render()
    {
        $parents = [];
        $children = [];

        if ($this->activeTab === 'parents') {
            $parents = DatarParent::query()
                ->when($this->search, function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('content', 'like', '%' . $this->search . '%');
                })
                ->withCount('children')
                ->orderBy('order')
                ->orderBy('title')
                ->paginate($this->perPage);
        } else {
            $children = Datar2::query()
                ->when($this->search, function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('content', 'like', '%' . $this->search . '%');
                })
                ->with('parent')
                ->orderBy('order')
                ->orderBy('title')
                ->paginate($this->perPage);
        }

        return view('livewire.phpcatcom.datar2.admin.datar-admin', [
            'parents' => $parents,
            'children' => $children,
        ]);
    }
}
