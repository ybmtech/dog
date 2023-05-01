<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breeding extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_dog_id',
        'second_dog_id',
        'fdog_user_id',
        'sdog_user_id',
        'reward',
        'amount',
        'amount_paid',
        'status',
        'reward_status',
    ];

    public function first_dog(){
        return $this->belongsTo(Dog::class,'first_dog_id');
    }

    public function second_dog(){
        return $this->belongsTo(Dog::class,'second_dog_id');
    }

    public function first_user(){
        return $this->belongsTo(User::class,'fdog_user_id');
    }

    public function second_user(){
        return $this->belongsTo(User::class,'sdog_user_id');
    }
    
}
