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
        'price',
        'category_id',
        'avg_score',
        'cash_payment',
        'card_payment',
        'bizum_payment',
        'stock',
        'available',
        'availability',
        'phone_number',
        'email',
        'location',
        'state',
        'created_at',
        'updated_at',
    ];

    // Relation between Entrepreneurships and Categories Table
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // Relation between Entrepreneurships and Users Table
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relation between Entrepreneurships and Comments Table
    public function comments(){
        return $this->hasMany(Comment::class);
    }

}
