<?php

namespace Farhadhp\SimpleTodo\Traits;

use Farhadhp\SimpleTodo\Models\Task;

trait SimpleTodo
{
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
