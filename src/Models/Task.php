<?php

namespace Farhadhp\SimpleTodo\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    const STATUS_OPEN = 1;
    const STATUS_CLOSE = 2;

    const ALL_STATUS = [
        self::STATUS_OPEN => 'Open',
        self::STATUS_CLOSE => 'Close',
    ];

    protected $guarded = ['id'];
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id'
    ];

    public function getStatusTitleAttribute()
    {
        return trans('task.status.' . Self::ALL_STATUS[$this->status],);
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class, "label_task");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeLabelFilter($query, $labelIds)
    {
        if (empty($labelIds)) {
            return $query;
        }
        return $query->whereHas("labels", function ($q) use ($labelIds) {
            $q->whereIn("label_id", $labelIds);
        });
    }

    public function scopeAuthor($query, $userId)
    {
        if (empty($userId)) {
            return $query;
        }
        return $query->where('user_id', $userId);
    }
}
