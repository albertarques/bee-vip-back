<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'card_name',
        'card_number',
        'expire_date',
        'type',
    ];

    // Relation between PaymentMethods and Users Table
    public function user(){
        return $this->belongsTo(User::class);
    }

}
