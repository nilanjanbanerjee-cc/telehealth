<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeleformSubmission extends Model
{
    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'answers',
        'status',
        'doctor_id'
    ];

    protected $casts = [
        'answers' => 'array'
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
