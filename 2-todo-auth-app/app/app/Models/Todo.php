<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    /** @use HasFactory<\Database\Factories\TodoFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'status',
        'assigned_user_id',
        'created_by',
        'created_pg',
        'updated_pg',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'todo_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }
}
