<?php

namespace App\Livewire\Phpcatcom\News\Admin;

use App\Models\News;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class NewsAdmin extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';
    public $image = '';
    public $is_published = '';
    public $perPage = 10;
    public $selectedNews = null;
    public $confirmingDeletion = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1]
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($newsId)
    {
        $this->selectedNews = News::find($newsId);
        $this->confirmingDeletion = true;
    }

    public function deleteNews()
    {
        if ($this->selectedNews) {
            // Удаляем изображение если есть
            if ($this->selectedNews->image && Storage::exists('public/' . $this->selectedNews->image)) {
                Storage::delete('public/' . $this->selectedNews->image);
            }

            $this->selectedNews->delete();
            $this->dispatch('news-deleted');
        }

        $this->confirmingDeletion = false;
        $this->selectedNews = null;
    }

    public function togglePublish($newsId)
    {
        $news = News::find($newsId);
        if ($news) {
            $news->update([
                'is_published' => !$news->is_published,
                'published_at' => $news->is_published ? null : now()
            ]);

            $this->dispatch('news-updated');
        }
    }

    public function render()
    {
        $news = News::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('content', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.phpcatcom.news.admin.news-admin', [
            'news' => $news,
        ]);
    }
}
