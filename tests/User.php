<?php

namespace Farhadhp\SimpleTodo\Tests;

use Farhadhp\SimpleTodo\Models\Task;
use Farhadhp\SimpleTodo\Traits\SimpleTodo;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends Model implements AuthorizableContract, AuthenticatableContract
{
    use Authorizable, Authenticatable, HasFactory;

    protected $guarded = [];

    protected $table = 'users';

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
