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
        'last_name',
        'phone',
        'verified',
        'image',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token'
    ];

    public function activeCode()
    {
        return $this->hasMany(ActiveCode::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function isSuperUser()
    {
        return $this->isSuperUser == 1;
    }

    public function isAdmin()
    {
        return $this->isAdmin == 1;
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission($permission)
    {
        return $this->permissions->contains('name', $permission->name);
    }

    public static function scopeFilterOrSearchUsers($query, $filterBy, $search)
    {
        if ($filterBy == 'actives') {
            $query = $query->where('verified', '1');
        } elseif ($filterBy == 'inactives') {
            $query = $query->where('verified', '0');
        }

        if ($search != null)
            $query = $query->where(function ($query) use ($search) { //for grouping wheres
                $query
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('id', $search);
            });

        return $query;
    }
}
