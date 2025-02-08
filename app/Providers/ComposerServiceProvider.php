<?php
namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // View::share('latestMovie', 'Hello world');
        

        View::composer('*', 'App\Http\ViewComposers\ProfileComposer@compose');


        // view()->composer('app', function($view){
        //     $view->with('latestMovie', 'Hello world');
        // });

        // view()->composer(
        //   'app',
        //   'App\Http\ViewComposers\MovieComposer'
        // );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
