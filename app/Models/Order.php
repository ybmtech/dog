<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

         /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'invoice_no',
        'user_id',
        'total',
        'status',
        'payment_status',
        'delivery_address',
        'delivery_fee'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function order_items(){
        return $this->hasMany(OrderItem::class);
    }

}
