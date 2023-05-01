<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'gender',
        'dob',
        'age',
        'image',
        'price',
        'healthy',
        'petid',
        'health_status',
        'healthy',
        'medication',
        'user_id',
        'last_breeding_date',
        'last_visit_date',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
