<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $primaryKey = 'comment_id';

    protected $fillable = [
        'comment_id',
        'story_id',
        'user_id',
        'comment',

    ];
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'user_id');
    }
    public function story()
    {
        return $this->belongsTo(Story::class, 'story_id');
    }
}
