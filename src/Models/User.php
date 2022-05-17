<?php

namespace Farhadhp\SimpleTodo\Models;

use Farhadhp\SimpleTodo\Traits\SimpleTodo;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends \App\User
{
    use Notifiable, SimpleTodo;

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
