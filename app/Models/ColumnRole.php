<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColumnRole extends Model
{
    use HasFactory;

    protected $table = 'column_role';

    protected $fillable = [
        'column_id',
        'role_id',
    ];

    public function column()
    {
        return $this->belongsTo(LeedColumn::class, 'column_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
