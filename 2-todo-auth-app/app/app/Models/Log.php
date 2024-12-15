<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
    /** @use HasFactory<\Database\Factories\LogFactory> */
    use HasFactory;

    protected $fillable = [
        'endpoint',
        'method',
        'request_payload',
        'response_payload',
        'user_id',
        'token_id',
        'created_pg',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function apiToken(): BelongsTo
    {
        return $this->belongsTo(ApiToken::class, 'token_id');
    }
}
