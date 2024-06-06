<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    protected $table = 'referrals';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'user_id',
        'first_name',
        'last_name',
        'email',
        'linkedin',
        'cv',
        'status',
    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'user_id');
    }
}

