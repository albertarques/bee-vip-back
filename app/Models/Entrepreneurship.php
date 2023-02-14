<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entrepreneurship extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'title',
        'logo',
        'product_img',
        'description',
        'category',
        'phone_number',
        'email',
        'avg_score',
        'payment_1',
        'payment_2',
        'payment_3',
        'stock',
        'availability',
        'created_at',
        'updated_at',
    ];

}
