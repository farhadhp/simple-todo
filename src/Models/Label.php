<?php

namespace Farhadhp\SimpleTodo\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [
        'title',
    ];
//    protected $appends = [
//        'tasksCount'
//    ];

    public function tasks()
    {
        return $this->belongsToMany(Task::class, "label_task");
    }

    public function getTasksCountAttribute()
    {
        // ToDo:: count for user tasks
        return $this->tasks()->count();
    }
}
