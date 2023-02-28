<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;


    protected $fillable = [
        'order_id',
        'entrepreneurship_id',
        'quantity',
        'paid',
        'created_at',
        'updated_at'
    ];

    // Relation between OrderDetails and Order Table
    public function order(){
        return $this->belongsTo(Order::class);
    }

    // Relation between OrderDetails and Entrepreneurship Table
    public function entrepreurship(){
        return $this->hasMany(Entrepreneurship::class);
    }
}
