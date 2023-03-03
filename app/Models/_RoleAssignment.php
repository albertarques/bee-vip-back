<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role_id'
    ];

    // Relation between RoleAssignment and Roles Table
    public function role(){
        return $this->belongsTo(Role::class);
    }

    // Relation between RoleAssignment and Users Table
    public function user(){
        return $this->belongsTo(User::class);
    }

}
