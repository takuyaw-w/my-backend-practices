<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Task
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $status
 * @property string $priority
 * @property \Carbon\Carbon|null $due_date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comment> $comments
 * @property-read int|null $comments_count
 *
 * @method static \Database\Factories\TaskFactory factory($count = null, $state = [])
 * @method static Builder<static>|Task fromDate(?string $from)
 * @method static Builder<static>|Task limitOffset(?int $limit, ?int $offset)
 * @method static Builder<static>|Task newModelQuery()
 * @method static Builder<static>|Task newQuery()
 * @method static Builder<static>|Task query()
 * @method static Builder<static>|Task status(?string $status)
 * @method static Builder<static>|Task toDate(?string $to)
 * @method static Builder<static>|Task whereCreatedAt($value)
 * @method static Builder<static>|Task whereDescription($value)
 * @method static Builder<static>|Task whereDueDate($value)
 * @method static Builder<static>|Task whereId($value)
 * @method static Builder<static>|Task wherePriority($value)
 * @method static Builder<static>|Task whereStatus($value)
 * @method static Builder<static>|Task whereTitle($value)
 * @method static Builder<static>|Task whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    public const SORTABLE_FIELDS = [
        'title',
        'status',
        'due_date',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];

    protected $attributes = [
        'status' => 'pending',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeStatus(Builder $query, ?string $status): Builder
    {
        if ($status) {
            return $query->where('status', $status);
        }

        return $query;
    }

    public function scopeFromDate(Builder $query, ?string $from): Builder
    {
        if ($from) {
            return $query->whereDate('created_at', '>=', $from);
        }

        return $query;
    }

    public function scopeToDate(Builder $query, ?string $to): Builder
    {
        if ($to) {
            return $query->whereDate('created_at', '<=', $to);
        }

        return $query;
    }

    public function scopeLimitOffset(Builder $query, ?int $limit, ?int $offset): Builder
    {
        if ($limit) {
            $query->limit($limit);
        }

        if ($offset) {
            $query->offset($offset);
        }

        return $query;
    }
}
