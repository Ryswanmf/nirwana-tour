<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Tentukan lokasi root folder project Laravel (lokal atau cPanel terpisah /home/nirwanat)
$basePath = __DIR__.'/..';
if (!file_exists($basePath . '/vendor/autoload.php')) {
    foreach (['nirwana', 'nirwana-tour', 'Nirwana-Tour-Lampung'] as $folder) {
        if (file_exists(__DIR__ . '/../' . $folder . '/vendor/autoload.php')) {
            $basePath = __DIR__ . '/../' . $folder;
            break;
        }
    }
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = $basePath.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require $basePath.'/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once $basePath.'/bootstrap/app.php';

$app->handleRequest(Request::capture());
