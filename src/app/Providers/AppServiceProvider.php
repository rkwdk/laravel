<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use App\Views\Composers\ProfileComposer;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(UserRepository::class,function(Application $app){
            return new UserRepository("ProfileComposer");
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //全てのViewで使用可能
        View::share('key', 'value');

        // クラスベースのコンポーザを使用する
        View::composer('*', ProfileComposer::class);

        // クロージャベースのコンポーザを使用
        View::composer('page.dashboard', function ($view) {
            //
        });

    }
}
