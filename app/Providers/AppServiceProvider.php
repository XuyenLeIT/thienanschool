<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\Carausel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            // Lấy user từ session (nếu có)
            $userLogin = session('auth_user');

            // Mặc định là null
            $user = null;

            // Kiểm tra tồn tại và có id hợp lệ
            if ($userLogin && isset($userLogin->id)) {
                $user = Account::find($userLogin->id);
            }

            // Chia sẻ biến (dù null vẫn chia sẻ được, không lỗi)
            $view->with('authUser', $user);
        });
    }
}
