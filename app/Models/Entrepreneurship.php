<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Entrepreneurship extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'user_id',
        'title',
        'logo',
        'image',
        'description',
        'category_id',
        'phone',
        'email',
        'avg_score',
        'payment_1',
        'payment_2',
        'payment_3',
        'stock',
        'availability',
        'created_at',
        'updated_at'
    ];

    
}
