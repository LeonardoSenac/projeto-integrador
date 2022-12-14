<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'age',
        'active'
    ];

    protected $with = [
        'experiences', 
        'services',
        'perfils'
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

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function services() 
    {
        return $this->belongsToMany(Service::class)
                    ->using(ServiceUser::class);
    }

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    public function perfils()
    {
        return $this->hasMany(Perfil::class);
    }
}
