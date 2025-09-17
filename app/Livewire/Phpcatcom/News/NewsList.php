<?php

namespace App\Livewire\Phpcatcom\News;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;

class NewsList extends Component
{
    use WithPagination;

    public $view = ''; // start
    public $search = '';
    public $perPage = 9;
    public $category = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1]
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {


if ($this->view === 'start') {
    // Возвращаем только 3 самые новые записи без пагинации
    $news = News::query()
        ->published()
        ->latestNews()
        ->when($this->search, function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('content', 'like', '%' . $this->search . '%');
        })
        ->take(3)
        ->get();
} else {
    // Возвращаем все записи с пагинацией
    $news = News::query()
        ->published()
        ->latestNews()
        ->when($this->search, function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('content', 'like', '%' . $this->search . '%');
        })
        ->paginate($this->perPage);
}



        return view('livewire.phpcatcom.news.news-list', [
            'news' => $news,
        ]);
    }
}
