<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DatarParent extends Model
{
    use HasFactory;

    protected $table = 'datar_parents';

    protected $fillable = [
        'title',
        'content',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    /**
     * Дочерние записи
     */
    public function children(): HasMany
    {
        return $this->hasMany(Datar2::class, 'parent_id');
    }

    /**
     * Активные дочерние записи
     */
    public function activeChildren(): HasMany
    {
        return $this->hasMany(Datar2::class, 'parent_id')
            ->where('is_active', true)
            ->orderBy('order');
    }

    /**
     * Scope для активных записей
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope с дочерними записями
     */
    public function scopeWithChildren($query)
    {
        return $query->with(['children' => function($q) {
            $q->orderBy('order');
        }]);
    }

    /**
     * Scope с активными дочерними записями
     */
    public function scopeWithActiveChildren($query)
    {
        return $query->with(['activeChildren']);
    }
}
