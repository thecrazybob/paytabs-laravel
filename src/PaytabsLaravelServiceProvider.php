<?php

namespace Thecrazybob\PaytabsLaravel;

use Illuminate\Support\ServiceProvider;
use Thecrazybob\PaytabsLaravel\Commands\PaytabsLaravelCommand;

class PaytabsLaravelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/paytabs-laravel.php' => config_path('paytabs-laravel.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/paytabs-laravel'),
            ], 'views');

            $migrationFileName = 'create_paytabs_laravel_table.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }

            $this->commands([
                PaytabsLaravelCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'paytabs-laravel');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/paytabs-laravel.php', 'paytabs-laravel');
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}
