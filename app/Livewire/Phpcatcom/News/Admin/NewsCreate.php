<?php

namespace App\Livewire\Phpcatcom\News\Admin;

use App\Models\News;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsCreate extends Component
{
    use WithFileUploads;

    public $title;
    public $content;
    public $excerpt;
    public $image;
    public $is_published = false;
    public $published_at;

    protected $rules = [
        'title' => 'required|string|min:5|max:255',
        'content' => 'required|string|min:10',
        'excerpt' => 'nullable|string|max:300',
        'image' => 'nullable|image|max:2048',
        'is_published' => 'boolean',
        'published_at' => 'nullable|date'
    ];

    public function save()
    {
        $this->validate();

        $newsData = [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'excerpt' => $this->excerpt,
            'is_published' => $this->is_published,
            'published_at' => $this->is_published ? ($this->published_at ?? now()) : null
        ];

        // Сохраняем изображение
        if ($this->image) {
            $imagePath = $this->image->store('news', 'public');
            $newsData['image'] = $imagePath;
        }

        News::create($newsData);

        session()->flash('success', 'Новость успешно создана!');
        return redirect()->route('tech.news.admin');
    }

    public function cancel()
    {
        return redirect()->route('news.admin');
    }

    public function render()
    {
        return view('livewire.phpcatcom.news.admin.news-create');
    }
}
