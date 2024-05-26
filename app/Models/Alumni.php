<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumnis';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'birthday',
        'join_year',
        'leave_year',
        'current_company',
        'current_job',
        'address',
        'city',
        'country',
        'no_hp',
        'linkedin',
        'photo',
        'status'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    
}
