<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ElastisearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [HomeController::class, 'login'])->name('login');


// Elasticsearch
Route::post('/create-index', [ElastisearchController::class, 'createIndex']);