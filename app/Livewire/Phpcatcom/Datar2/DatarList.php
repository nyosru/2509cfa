<?php

namespace App\Livewire\Phpcatcom\Datar2;

use App\Models\DatarParent;
use Livewire\Component;
use Livewire\WithPagination;

class DatarList extends Component
{
    use WithPagination;

    public $selectedParentId = null;
    public $selectedParent = null;
    public $search = '';
    public $perPage = 10;
    public $isLoading = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedParentId' => ['except' => null]
    ];

    public function mount()
    {
        // При загрузке компонента проверяем, есть ли выбранный родитель
        if ($this->selectedParentId) {
            $this->loadSelectedParent();
        }
    }

    protected function loadSelectedParent()
    {
        $this->isLoading = true;

        try {
            $this->selectedParent = DatarParent::with('activeChildren')
                ->find($this->selectedParentId);

            // Если родитель не найден (был удален), сбрасываем выбор
            if (!$this->selectedParent) {
                $this->selectedParentId = null;
            }
        } catch (\Exception $e) {
            // В случае ошибки сбрасываем выбор
            $this->selectedParentId = null;
            $this->selectedParent = null;
        } finally {
            $this->isLoading = false;
        }
    }

    public function selectParent($parentId)
    {
        $this->selectedParentId = $parentId;
        $this->loadSelectedParent();

        // Отправляем событие для прокрутки к блоку
        if ($this->selectedParent) {
            $this->dispatch('scroll-to-content');
        }
    }

    public function backToList()
    {
        $this->selectedParentId = null;
        $this->selectedParent = null;
        $this->resetPage();
        $this->dispatch('scroll-to-content');
    }

    public function updatedSearch()
    {
        $this->resetPage();
        $this->selectedParentId = null;
        $this->selectedParent = null;
    }

    public function render()
    {
        $parents = DatarParent::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('content', 'like', '%' . $this->search . '%');
            })
            ->withCount(['children as active_children_count' => function ($query) {
                $query->where('is_active', true);
            }])
            ->active()
            ->orderBy('order')
            ->orderBy('title')
            ->paginate($this->perPage);

        return view('livewire.phpcatcom.datar2.datar-list', [
            'parents' => $parents,
        ]);
    }
}
