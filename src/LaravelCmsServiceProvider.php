<?php

namespace PhpCorp\LaravelCms;

use Illuminate\Support\ServiceProvider;

class LaravelCmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Register any package services here
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish migrations
        $this->publishes([
            __DIR__.'/database/migrations/CMS' => database_path('migrations/CMS'),
        ], 'laravel-cms-migrations');

        // Publish seeders
        $this->publishes([
            __DIR__.'/database/seeders/CMS' => database_path('seeders/CMS'),
        ], 'laravel-cms-seeders');

        // Publish Helpers directory and all its contents recursively
        $this->publishes([
            __DIR__.'/Helpers/CMS' => base_path('app/Helpers/CMS'),
        ], 'laravel-cms-helpers');

        // Publish Controllers directory for CMS and Frontend
        $this->publishes([
            __DIR__.'/Http/Controllers/CMS' => app_path('Http/Controllers/CMS'),
        ], 'laravel-cms-controllers');
        
        $this->publishes([
            __DIR__.'/Http/Controllers/Frontend' => app_path('Http/Controllers/Frontend'),
        ], 'laravel-cms-controllers');

        // Publish Mail directory and all its contents recursively
        $this->publishes([
            __DIR__.'/Mail/CMS' => base_path('app/Mail/CMS'),
        ], 'laravel-cms-mail');

        // Publish Models directory and all its contents recursively
        $this->publishes([
            __DIR__.'/Models/CMS' => app_path('Models/CMS'),
        ], 'laravel-cms-models');

        // Publish routes directory and web_cms.php
        $this->publishes([
            __DIR__.'/routes/Sample' => base_path('routes/Sample'),
        ], 'laravel-cms-routes');
        
        $this->publishes([
            __DIR__.'/routes/web_cms.php' => base_path('routes/web_cms.php'),
        ], 'laravel-cms-web-cms');

        // Publish the entire cms directory and specific views
        $this->publishes([
            __DIR__.'/resources/cms' => resource_path('cms'),
        ], 'laravel-cms-resources-cms');
        
        $this->publishes([
            __DIR__.'/resources/views/cms' => resource_path('views/cms'),
        ], 'laravel-cms-views-cms');
        
        $this->publishes([
            __DIR__.'/resources/views/frontend' => resource_path('views/frontend'),
        ], 'laravel-cms-views-frontend');

        // Publish PostCSS, Tailwind, Vite, and Vue configuration files
        $this->publishes([
            __DIR__.'/postcss.config.js' => base_path('postcss.config.js'),
        ], 'laravel-cms-postcss');
        
        $this->publishes([
            __DIR__.'/tailwind.config.js' => base_path('tailwind.config.js'),
        ], 'laravel-cms-tailwind');
        
        $this->publishes([
            __DIR__.'/vite.config.js' => base_path('vite.config.js'),
        ], 'laravel-cms-vite');
        
        $this->publishes([
            __DIR__.'/vue.config.js' => base_path('vue.config.js'),
        ], 'laravel-cms-vue');

        $this->publishes([
            __DIR__.'/package.json' => base_path('package.json'),
        ], 'laravel-cms-package-json');


        
        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/database/migrations/CMS');
        // $this->loadRoutesFrom(__DIR__.'/routes/web_cms.php');

    }
}
