<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'picture',
        'email',
        'password',
        'phone',
        'state',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relation between Users and Entrepreneurships Table
    public function entrepreneurships(){
        return $this->hasMany(Entrepreneurship::class);
    }

    // Relation between Users and Orders Table
    public function orders(){
        return $this->hasMany(Order::class);
    }

    // Relation between Users and PaymentMethods Table
    public function paymentMethods(){
        return $this->hasMany(PaymentMethod::class);
    }

    // Relation between Users and JWTIdentifier Table
    public function getJWTIdentifier(){
        return $this->getKey();
    }

    // Relation between Users and RoleAssignments Table
    public function roleAssignment(){
        return $this->hasOne(RoleAssignment::class);
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
