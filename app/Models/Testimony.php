<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    use HasFactory;
    protected $table = 'testimonies';

    protected $primaryKey = 'testimony_id';

    protected $fillable = [
        'testimony_id',
        'user_id',
        'content',

    ];
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'user_id');
    }
}
