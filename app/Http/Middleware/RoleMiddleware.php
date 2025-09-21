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
        // Lấy user id từ session
        $userId = session('user_id');

        if (!$userId) {
            return redirect()->route('login');
        }

        // Lấy user thực tế
        $user = Account::find($userId);

        if (!$user) {
            session()->forget('user_id');
            return redirect()->route('login');
        }

        // Ghi log để debug role hiện tại
        \Log::info('RoleMiddleware - Auth User:', [
            'id' => $user->id,
            'role' => $user->role,
            'roles_required' => $roles
        ]);

        // Kiểm tra role nếu truyền vào
        if (!empty($roles) && !in_array($user->role, $roles)) {
            dd($roles);
            abort(403, 'Bạn không có quyền truy cập');
        }

        // Gán user vào request để controller/view sử dụng
        $request->merge(['auth_user' => $user]);

        return $next($request);
    }
}
