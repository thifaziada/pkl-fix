<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $table = 'stories';

    protected $primaryKey = 'story_id';

    protected $fillable = [
        'story_id',
        'user_id',
        'story',

    ];
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'story_id');
    }
}
