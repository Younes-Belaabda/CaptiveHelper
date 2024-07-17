<?php

    require_once __DIR__ . '/vendor/autoload.php';

    $router = new AltoRouter();

    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $router->map('GET', '/', [App\Controllers\HomepageController::class , 'index']);
    $router->map('GET', '/recap-of-the-day', 
    [App\Controllers\TaskController::class , 'index']);

    \App\Core\Route::match($router);