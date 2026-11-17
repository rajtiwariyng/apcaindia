<?php

namespace App\Providers;

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
        // Ported views keep their legacy l5-modular namespaces (`Admin::`, `Home::`, …).
        View::addNamespace('Admin', resource_path('views/admin'));
        View::addNamespace('Header', resource_path('views/header'));
        View::addNamespace('Home', resource_path('views/home'));
        View::addNamespace('Footer', resource_path('views/footer'));
        View::addNamespace('Aboutus', resource_path('views/aboutus'));
        View::addNamespace('Blogpage', resource_path('views/blogpage'));
        View::addNamespace('Categories', resource_path('views/categories'));
        View::addNamespace('Courses', resource_path('views/courses'));
        View::addNamespace('Contactus', resource_path('views/contactus'));
    }
}
