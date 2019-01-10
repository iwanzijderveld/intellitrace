<?php namespace Insanetlabs\IntelliTrace;
/**
 * @author Iwan van Zijderveld <iwanzijderveld@gmail.com>
 * @package intelliTrace
 * 
 */
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Insanetlabs\IntelliTrace\Controllers\IntelliTraceController;
use Insanetlabs\IntelliTrace\Middleware\LogVisitorDataMiddleware;
use Insanetlabs\IntelliTrace\ViewComposers\IntellitraceMenuComposer;

class IntelliTraceServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        /**
         * Database migrations
         */
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        /**
         * Translation
         */
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'intellitrace');

        /**
         * Controllers
         */
        $this->app->make('Insanetlabs\IntelliTrace\Controllers\IntelliTraceController');
        $this->app->make('Insanetlabs\IntelliTrace\Controllers\Auth\LoginController');
        $this->app->make('Insanetlabs\IntelliTrace\Controllers\Auth\RegisterController');
        $this->app->make('Insanetlabs\IntelliTrace\Controllers\Auth\ForgotPasswordController');
        $this->app->make('Insanetlabs\IntelliTrace\Controllers\Auth\ResetPasswordController');

        /**
         * Routes
         */
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        /**
         * Views
         */
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'intellitrace');

        $this->publishes([__DIR__ . '/../resources/css' => public_path('vendor/intellitrace/css')], 'public');
        /**
         * Merge configuration files
         */
        $this->mergeConfigFrom(__DIR__ . '/../config/guards.php', 'auth.guards');
        $this->mergeConfigFrom(__DIR__ . '/../config/providers.php', 'auth.providers');
        $this->mergeConfigFrom(__DIR__ . '/../config/passwords.php', 'auth.passwords');
        
        // Add middleware to group
        $router->pushMiddlewareToGroup('web', LogVisitorDataMiddleware::class);


        View::composer('intellitrace::layouts.app', IntellitraceMenuComposer::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // register funcitons here
    }

}
?>