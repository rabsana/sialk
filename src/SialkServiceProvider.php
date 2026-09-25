<?php

declare(strict_types=1);

namespace Rabsana\Sialk;

use Illuminate\Support\ServiceProvider;
use Rabsana\Sialk\Builders\JsonResponseBuilder;
use Rabsana\Sialk\Console\Commands\SialkCommand;
use Rabsana\Sialk\Contracts\Builders\ResponseBuilderInterface;
use Rabsana\Sialk\Contracts\Services\QuestInterface;
use Rabsana\Sialk\Contracts\Support\HttpClientInterface;
use Rabsana\Sialk\Contracts\Support\MathInterface;
use Rabsana\Sialk\Contracts\Support\NetworkingInterface;
use Rabsana\Sialk\Services\QuestService;
use Rabsana\Sialk\Support\HttpClient;
use Rabsana\Sialk\Support\Math;
use Rabsana\Sialk\Support\Networking;

class SialkServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/sialk.php', 'sialk');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->app->singleton(Sialk::class);

        $this->app->bind(MathInterface::class, Math::class);

        $this->app->bind(NetworkingInterface::class, Networking::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(
            HttpClientInterface::class,
            HttpClient::class,
        );

        $this->app->bind(
            ResponseBuilderInterface::class,
            JsonResponseBuilder::class,
        );

        $this->app->bind(
            QuestInterface::class,
            QuestService::class,
        );

        $this->loadRoutesFrom(__DIR__.'/../routes/sialk.php');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'sialk');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'sialk');

        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../config/sialk.php' => config_path('sialk.php'),
        ], ['sialk', 'rabsana-sialk-config']);

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/sialk'),
        ], ['sialk', 'rabsana-sialk-views']);

        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/sialk'),
        ], ['sialk', 'rabsana-sialk-lang']);

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/sialk'),
        ], ['sialk', 'rabsana-sialk-assets']);

        $this->publishesMigrations([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], ['sialk', 'rabsana-sialk-migrations']);

        $this->commands([
            SialkCommand::class,
        ]);
    }
}
