<?php

namespace App\Providers;

use App\Category;
use App\Promotion;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringlength(191);

        View::share('categoriesMenu', Category::where('id', '>=', 1)->inRandomOrder()->take(8)->get());
        view::share('promotions', Promotion::all());
        view::share('date', Carbon::now()->toDateTimeString());    
    }
}
