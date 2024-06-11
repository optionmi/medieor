<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PeterColes\Countries\CountriesFacade as Countries;

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

    public function groupRequest()
    {
        return $this->belongsToMany('\App\Models\Group', 'group_user', 'user_id', 'group_id')->wherePivot('status', 0);
    }

    public function groups()
    {
        return $this->belongsToMany('\App\Models\Group', 'group_user', 'user_id', 'group_id')->wherePivot('status', 1);
    }

    public function ownedGroups()
    {
        return $this->hasMany('\App\Models\Group', 'created_by');
    }

    public function likes()
    {
        return $this->hasMany('\App\Models\Like', 'user_id');
    }

    public function notifications()
    {
        return $this->hasMany('\App\Models\UserNotification', 'user_id');
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role')->withTimestamps();
    }

    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function hasPermission($permission)
    {
        return $this->roles()->whereHas('permissions', function ($query) use ($permission) {
            $query->where('name', $permission);
        })->exists();
    }

    public function getCountryNameAttribute()
    {
        if ($this->country) {
            return Countries::countryName($this->country, 'en');
        }
    }

    // public function categories()
    // {
    //     return $this->hasManyThrough(
    //         Category::class,
    //         Group::class,
    //         'category_id', // Foreign key on the groups table.
    //         'id',          // Foreign key on the group_user table.
    //         'id',          // Local key on the categories table.
    //         'id'           // Local key on the groups table (to be used with group_user.group_id).
    //     );
    // }
    // public function categories()
    // {
    //     return $this->hasManyThrough(
    //         Category::class,
    //         GroupUser::class,
    //         'user_id', // Foreign key on Groups table...
    //         'id', // Foreign key on Categories table...
    //         'id', // Local key on Users table...
    //         'id' // Local key on Groups table...
    //     );
    // }
    public function getCategoriesAttribute()
    {
        return $this->groups()->with('category')->get()->pluck('category')->unique('id');
    }
}
