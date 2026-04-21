<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Secretaire extends Model
{
    protected $table = 'secretaires';

    protected $fillable = [
        'user_id',
        'cin',
        'bureau',
        'adresse',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
