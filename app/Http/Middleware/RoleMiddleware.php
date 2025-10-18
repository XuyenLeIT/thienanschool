<?php

namespace App\Http\Middleware;

use App\Models\Account;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $userLogin = session('auth_user');

        if (!$userLogin) {
            return redirect()->route('login');
        }

        $lastActivity = session('last_activity');
        $timeout = 20 * 60;

        if (!$lastActivity) {
            // Nếu chưa có last_activity => khởi tạo lần đầu
            session(['last_activity' => time()]);
        } elseif (time() - $lastActivity > $timeout) {
            session()->forget(['auth_user', 'last_activity']);
            return redirect()->route('login')->with('warning', 'Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại.');
        } else {
            // Cập nhật hoạt động
            session(['last_activity' => time()]);
        }
        // Kiểm tra user có tồn tại trong DB
        $user = Account::find($userLogin->id);
        if (!$user) {
            session()->forget('auth_user');
            return redirect()->route('login');
        }

        Log::info('RoleMiddleware - Auth User', [
            'id' => $user->id,
            'role' => $user->role,
            'roles_required' => $roles
        ]);

        // Kiểm tra quyền (role)
        if (!empty($roles) && !in_array($user->role, $roles)) {
            abort(403, 'Bạn không có quyền truy cập');
        }

        $request->attributes->set('auth_user', $user);

        return $next($request);
    }
}
