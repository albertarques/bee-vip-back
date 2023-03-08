<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'entrepreneurship_id',
        'user_id',
        'score',
        'comment',
        // 'created_at',
        // 'updated_at',
    ];

    // Relation between Comments and Entrepreneurships Table
    public function entrepreneurship(){
        return $this->belongsTo(Entrepreneurship::class);
    }

}
