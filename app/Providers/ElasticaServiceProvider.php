<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Elastica\Client;

class ElasticaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Client::class, function ($app) {
            return new Client([
                'host' => config('api.elastisearch.host'),
                'port' => config('api.elastisearch.port'),
                'transport' => 'https',
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode(config('api.elastisearch.username') . ':' . config('api.elastisearch.ELASTICSEARCH_PASSWORD')),
                ],
                'ssl' => ['verify_peer' => false, 'verify_peer_name' => false]
            ]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
