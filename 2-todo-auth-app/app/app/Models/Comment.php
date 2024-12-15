<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'body',
        'user_id',
        'todo_id',
        'created_pg',
        'updated_pg',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function todo(): BelongsTo
    {
        return $this->belongsTo(Todo::class, 'todo_id');
    }
}
