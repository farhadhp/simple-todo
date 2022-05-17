<?php

use Farhadhp\SimpleTodo\Http\Middleware\UserTokenAuthorize;

return [
    'middleware' => [
        'api' => UserTokenAuthorize::class
    ],
];
