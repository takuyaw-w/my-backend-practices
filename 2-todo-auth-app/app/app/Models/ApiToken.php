<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApiToken extends Model
{
    /** @use HasFactory<\Database\Factories\ApiTokenFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'token',
        'expires_at',
        'created_pg',
        'updated_pg',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function logs()
    {
        return $this->belongsTo(Log::class, 'token_id');
    }
}
