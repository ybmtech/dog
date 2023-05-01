<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwaitingBreed extends Model
{
    use HasFactory;

    protected $fillable = [
        'dog_id',
        'gender',
        'user_id',
        'name',
        'image',
        'bread',
    ];
}
