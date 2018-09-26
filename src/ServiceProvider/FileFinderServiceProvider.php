<?php
/*
 * This file is part of the Local File Finder package.
 *
 * (c) Muhamamad Hari S <hi.muhammad.hari@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Muharihar\FileFinder\ServiceProvider;

use Illuminate\Support\ServiceProvider;

/**
 * FileFinderServiceProvider class
 */
class FileFinderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Assets
        // publish command: php artisan vendor:publish --tag=public --force
        $this->publishes([
            __DIR__.'/../../pkg-assets/static-file-finder' => public_path('static-file-finder'),
        ], 'public');

        $this->publishes([
            __DIR__.'/../../pkg-assets/data-samples/file-finder' => storage_path('app/public/file-finder'),
        ], 'public');
        
        //Routes
        include __DIR__.'/../routes.php';
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Muharihar\FileFinder\FileFinder');
        
        // Register Controller
        $this->app->make('Muharihar\FileFinder\Controller\SwaggerController');
        $this->app->make('Muharihar\FileFinder\Controller\FileFinderController');

        $this->loadViewsFrom(__DIR__.'/../views', 'FileFinder');
    }
}
