<?php

namespace App\Providers;

use App\Services\CurrencyConversion;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['layouts.master', 'categories'], 'App\ViewComposers\CategoriesComposer');
        View::composer(['layouts.master'], 'App\ViewComposers\CurrenciesComposer');
        View::composer(['layouts.master', 'order'], 'App\ViewComposers\ContactsComposer');
        View::composer(['layouts.master'], 'App\ViewComposers\BestProductsComposer');

        View::composer('*', function($view){
            $currencySymbol = CurrencyConversion::getCurrencySymbol();
            $view->with('currencySymbol', $currencySymbol);
        });

    }
}
