<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];

    // Relation between Categories and Entrepreneurships Table
    public function entrepreneurships(){
        return $this->hasMany(Entrepreneurship::class);
    }
}
