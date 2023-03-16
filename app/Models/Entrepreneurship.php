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
        'name',
        'title',
        'logo',
        'description',
        'product_img',
        'price',
        'category_id',
        'avg_score',
        'cash_payment',
        'card_payment',
        'bizum_payment',
        'stock',
        'availability_state',
        'phone',
        'email',
        'location',
        'inspection_state',
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

    //  Relation between Entrepreneurships and  Inspection state Table
    public function inspectionState()
    {
    return $this->hasOne(InspectionState::class);
    }

    // Relation between Entrepreneurships and  Availability state Table
    public function availabilityState()
    {
        return $this->hasOne(AvailabilityState::class);
    }

}
