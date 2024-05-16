<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Agent;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\RequestAgent;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'role'
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
        'password' => 'hashed',
    ];
    /**
    * Get the agent associated with the User
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class);
    }
    
    /**
    * Get the agent associated with the User
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function agent(): HasOne
    {
        return $this->hasOne(Agent::class);
    }
	/**
    * Get the agent associated with the User
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function request(): HasOne
    {
        return $this->hasOne(RequestAgent::class);
    }
    /**
    * The roles that belong to the User
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    
    /**
     * Get all of the booking for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
