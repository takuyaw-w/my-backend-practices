<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'created_pg',
        'updated_pg',
    ];

    public function apiTokens()
    {
        return $this->hasMany(ApiToken::class, 'user_id');
    }

    public function todos()
    {
        return $this->hasMany(Todo::class, 'created_by');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function logs()
    {
        return $this->hasMany(Log::class, 'user_id');
    }
}
