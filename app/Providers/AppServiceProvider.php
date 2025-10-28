<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
// importo schema per utilizzare il model category nella funzione boot solo se esiste la tabella nel database
use Illuminate\Support\Facades\Schema;
use App\Category;

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

        if (Schema::hasTable('categories')) {
            $tutteCategorie = Category::all();
            View::share('listaDiCategorie', $tutteCategorie);
        }
    }
}
