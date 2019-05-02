<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.sidebar', function ($view){
            $categories = Category::with(['posts'=>function($query){
                $query->published();
            }])->orderBy('title', 'asc')->get();
            return $view->with('categories',$categories);
        });
    }
}
