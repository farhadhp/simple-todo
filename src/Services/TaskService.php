<?php

namespace Farhadhp\SimpleTodo\Services;

use Farhadhp\SimpleTodo\Models\Task;


class TaskService
{
    public function create(array $taskData, $user): Task
    {
        $task = new Task();
        $task->title = $taskData['title'];
        $task->description = $taskData['description'];
        $task->user_id = $user->id;
        $task->status = Task::STATUS_OPEN;
        $task->save();

        if (!empty($taskData['labels'])) {
            $labels = array_unique($taskData['labels']);
            $labelIds = (new LabelService())->getIds($labels);

            $task->labels()->sync($labelIds);
        }

        return $task->loadMissing('labels');
    }

    public function update(Task $task, array $data): Task
    {
        $task->update($data);

        return $task->loadMissing('labels');
    }

    public function notifOnCloseTask(Task $task)
    {
        (new NotificationService())->dispatchTaskColseNotif($task);
    }
}
