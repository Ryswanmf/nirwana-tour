<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Jadwal Otomatis Cadangan Database Harian Setiap Pukul 02:00 Pagi
Schedule::command('app:backup-database')
    ->dailyAt('02:00')
    ->appendOutputTo(storage_path('logs/backup-schedule.log'));

