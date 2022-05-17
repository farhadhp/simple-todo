<?php

namespace Farhadhp\SimpleTodo\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserTokenAuthorize
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userModel = config('auth.providers.users.model');

        if (!$request->hasHeader('authorization')) {
            return response()->json([
                'message' => trans('auth.failed'),
            ], 422);
        }

        $authorization = explode(' ', $request->header('authorization', ' '));

        if (trim($authorization[0]) == 'Bearer') {
            $user = $userModel::where('token', trim($authorization[1]))->firstOrFail();
            Auth::setUser($user);
        }
        return $next($request);
    }
}
