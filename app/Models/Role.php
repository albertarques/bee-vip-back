<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
    ];

    // // Relation between Roles and RoleAssignments Table
    public function roleassignments(){
        return $this->hasMany(RoleAssignment::class);
    }

}
