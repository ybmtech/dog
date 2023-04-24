<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;

    protected $fillable = 
        [
            'user_id',
            'reference_no',
            'transaction_ref',
            'amount'
    ];
}
