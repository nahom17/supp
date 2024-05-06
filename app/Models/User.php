<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Staudenmeir\LaravelMergedRelations\Eloquent\HasMergedRelationships;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasMergedRelationships;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'name',  'image', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //role and user relationship
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function friends()
    {
        return $this->hasMany(Friend::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function sharedPosts()
    {
        return $this->hasMany(SharePost::class);
    }
    public function privacy()
    {
        return $this->belongsTo(Privacy::class);
    }

}
