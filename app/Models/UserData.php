<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $fillable = [
        'user_id',
        'information',
    ];

    protected $casts = [
        'information' => 'array',
    ];

    protected $attributes = [
        'information' => '{}',
    ];
}
