<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ElastisearchController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user', [HomeController::class, 'index']);

// Elastisearch

Route::get('/search', [ElastisearchController::class, 'index']);


Route::get('/test-elastica', function () {
    $client = new \Elastica\Client([
        'host' => env('ELASTICSEARCH_HOST', 'localhost'),
        'port' => env('ELASTICSEARCH_PORT', 9200),
        'transport' => 'https',
        'headers' => [
            'Authorization' => 'Basic ' . base64_encode(env('ELASTICSEARCH_USERNAME') . ':' . env('ELASTICSEARCH_PASSWORD')),
        ],
        'ssl' => ['verify_peer' => false, 'verify_peer_name' => false]  // For self-signed certificates
    ]);

    try {
        $status = $client->getStatus();
        return response()->json(['status' => 'Connected to Elasticsearch']);
    } catch (\Elastica\Exception\ConnectionException $e) {
        return response()->json(['error' => 'Cannot connect to Elasticsearch', 'message' => $e->getMessage()]);
    }
});


