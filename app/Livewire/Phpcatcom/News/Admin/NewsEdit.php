<?php

namespace App\Livewire\Phpcatcom\News\Admin;

use App\Models\News;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsEdit extends Component
{
    use WithFileUploads;

    public $news;
    public $title;
    public $content;
    public $excerpt;
    public $image;
    public $currentImage;
    public $is_published;
    public $published_at;
    public $removeImage = false;

    protected $rules = [
        'title' => 'required|string|min:5|max:255',
        'content' => 'required|string|min:10',
        'excerpt' => 'nullable|string|max:300',
        'image' => 'nullable|image|max:2048',
        'is_published' => 'boolean',
        'published_at' => 'nullable|date'
    ];

    public function mount($id)
    {
        $this->news = News::findOrFail($id);
        $this->title = $this->news->title;
        $this->content = $this->news->content;
        $this->excerpt = $this->news->excerpt;
        $this->currentImage = $this->news->image;
        $this->is_published = $this->news->is_published;
        $this->published_at = $this->news->published_at?->format('Y-m-d\TH:i');
    }

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

        // Обработка изображения
        if ($this->removeImage && $this->currentImage) {
            Storage::delete('public/' . $this->currentImage);
            $newsData['image'] = null;
            $this->currentImage = null;
        }

        if ($this->image) {
            // Удаляем старое изображение если есть
            if ($this->currentImage) {
                Storage::delete('public/' . $this->currentImage);
            }

            $imagePath = $this->image->store('news', 'public');
            $newsData['image'] = $imagePath;
            $this->currentImage = $imagePath;
        }

        $this->news->update($newsData);

        session()->flash('success', 'Новость успешно обновлена!');
        return redirect()->route('news.admin');
    }

    public function cancel()
    {
        return redirect()->route('news.admin');
    }

    public function render()
    {
        return view('livewire.phpcatcom.news.admin.news-edit', [
            'newsItem' => $this->news
        ]);
    }
}
