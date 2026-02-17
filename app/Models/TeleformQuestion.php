<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeleformQuestion extends Model
{
    protected $fillable = [
        'step_id',
        'question',
        'type',
        'field_key'
    ];

    public function step()
    {
        return $this->belongsTo(TeleformStep::class, 'step_id');
    }
}
