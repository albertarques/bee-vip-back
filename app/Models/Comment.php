<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'entrepreneurship_id',
        'user_id',
        'score',
        'comment',
        'created_at',
        'updated_at',
    ];

    public function entrepreneurship(){
        return $this->belongsTo(Entrepreneurship::class);
    }

}
