<?php

namespace App\Http\Middleware;

use App\Models\User;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        $user = User::find($userId);
        if (!$user) {
            $request->session()->forget('user_id');
            return redirect()->route('login');
        }

        // Nếu có truyền role thì check
        if (!empty($roles) && !in_array($user->role, $roles)) {
            abort(403, 'Bạn không có quyền truy cập');
        }

        // gán user vào request
        $request->merge(['auth_user' => $user]);

        return $next($request);
    }
}
