<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeedRecordComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'leed_record_id',
        'user_id',
        'comment',
        'parent_id',
        'readed',
        'addressed_to_user_id'
    ];

//    protected $listeners = [
//        'updateParentCommentId' => 'updateParentCommentId',
//    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function leed()
    {
        return $this->belongsTo(LeedRecord::class, 'leed_record_id');
    }
    public function files()
    {
        return $this->hasMany(LeedCommentFile::class, 'leed_record_comment_id');
    }
    // Связь с родительским комментарием
    public function parentComment()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    // Связь с дочерними комментариями
    public function childComments()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function addressedToUser()
    {
        return $this->belongsTo(User::class, 'addressed_to_user_id');
    }

}
