<?php

namespace Farhadhp\SimpleTodo\Observers;

use Farhadhp\SimpleTodo\Models\Task;
use Farhadhp\SimpleTodo\Services\TaskService;
use Illuminate\Support\Arr;

class TaskObserver
{
    /**
     * Handle the task "updated" event.
     *
     * @param Task $task
     * @return void
     */
    public function updated(Task $task)
    {
        $dirtyItems = $task->getDirty();
        if (Arr::exists($dirtyItems, 'status')) {
            if ($dirtyItems['status'] == Task::STATUS_CLOSE) {
                (new TaskService())->notifOnCloseTask($task);
            }
        }
    }
}
