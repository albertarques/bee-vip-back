<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'provider_id',
        'customer_id',
        'created_at',
        'updated_at'
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

   
}
