<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('locale', function ($locale) {
            return app()->getLocale() === $locale;
        });

        Blade::if('environment', function ($environment) {
            return app()->environment($environment);
        });

        Blade::aliasComponent('layouts.components.admin_menu', 'amenu');
        Blade::aliasComponent('layouts.components.admin_menu_group', 'amenugroup');
    }
}
