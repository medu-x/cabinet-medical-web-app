<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Send reminder emails every day at 08:00 to patients with an appointment the next day
Schedule::command('rappel:rendezvous')->dailyAt('08:00');
