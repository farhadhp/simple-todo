<?php

namespace Farhadhp\SimpleTodo\Services;

use Farhadhp\SimpleTodo\Mail\TaskCloseMail;
use Farhadhp\SimpleTodo\Models\Task;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    public function dispatchTaskColseNotif(Task $task)
    {
        $this->log($task);
        $this->snedMail($task);
    }

    public function snedMail(Task $task)
    {
        if ($email = auth()->user()->email) {
            Mail::to($email)->send(new TaskCloseMail($task));
        }

        $this->log($task);
    }

    public function log(Task $task)
    {
        $message = 'Task: #' . $task->id . ' ' . $task->title . ' closed at ' . $task->updated_at . "\n";
        Log::alert($message);
    }
}
