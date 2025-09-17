<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Datar2 extends Model
{
    use HasFactory;

    protected $table = 'datar2s';

    protected $fillable = [
        'title',
        'content',
        'parent_id',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    /**
     * Родительская запись
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(DatarParent::class, 'parent_id');
    }

    /**
     * Scope для активных записей
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope для записей определенного родителя
     */
    public function scopeByParent($query, $parentId)
    {
        return $query->where('parent_id', $parentId);
    }

    /**
     * Scope для сортировки по порядку
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
