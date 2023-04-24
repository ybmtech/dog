<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'dog_id',
        'quantity',
        'price',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function dog(){
        return $this->belongsTo(Dog::class);
    }
}
