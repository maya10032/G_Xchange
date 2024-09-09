<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Cart;


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
        Paginator::useBootstrapFive();

        view()->composer('*', function ($view) {
            $cartCount = 0;
            $likeCount = 0;

            if (auth()->check()) {
                $cartCount = Cart::where('user_id', auth()->id())->sum('count');

                // ログインユーザーが通常のユーザーの場合にのみ likeItems() を取得
                if (auth()->user() instanceof \App\Models\User && auth()->user()->likeItems()->exists()) {
                    $likeCount = auth()->user()->likeItems()->count();
                }
            }

            $view->with([
                'cartCount' => $cartCount,
                'likeCount' => $likeCount,
            ]);
        });
    }
}
