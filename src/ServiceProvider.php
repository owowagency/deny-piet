<?php

namespace OwowAgency\DenyPiet;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * The name of the package.
     *
     * @var string
     */
    private string $name = 'deny-piet';
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../translations', $this->name);

        $this->registerPublishableFiles();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . "/../config/$this->name.php", $this->name);
    }

    /**
     * Register files to be published by the publish command.
     *
     * @return void
     */
    protected function registerPublishableFiles(): void
    {
        $this->publishes(
            [
                __DIR__ . "/../config/$this->name.php" => config_path("$this->name.php"),
            ],
            [$this->name, "$this->name.config", 'config'],
        );
    }
}
