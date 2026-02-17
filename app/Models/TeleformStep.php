<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeleformStep extends Model
{
    protected $fillable = [
        'title',
        'step_order',
        'is_final'
    ];

    public function questions()
    {
        return $this->hasMany(TeleformQuestion::class, 'step_id');
    }
}
