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
            // Lấy user từ session
            $userLogin = session('auth_user');
            // Lấy user từ DB
            $user = Account::find($userLogin->id);
            $view->with('authUser', $user);
        });
    }
}
