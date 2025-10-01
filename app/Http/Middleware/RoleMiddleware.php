<?php

namespace App\Http\Middleware;

use App\Models\Account;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Lấy user từ session
        $userLogin = session('auth_user');

        if (!$userLogin) {
            return redirect()->route('login');
        }

        // Lấy user từ DB
        $user = Account::find($userLogin->id);
        view()->share('authUser', $user);
        if (!$user) {
            // Xoá đúng key session
            session()->forget('auth_user');

            return redirect()->route('login');
        }

        // Ghi log để debug
        \Log::info('RoleMiddleware - Auth User', [
            'id' => $user->id,
            'role' => $user->role,
            'roles_required' => $roles
        ]);

        // Kiểm tra role
        if (!empty($roles) && !in_array($user->role, $roles)) {
            abort(403, 'Bạn không có quyền truy cập');
        }

        // Đưa user vào request
        $request->attributes->set('auth_user', $user);

        return $next($request);
    }
}
