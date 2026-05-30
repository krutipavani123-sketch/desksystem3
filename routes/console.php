<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::command('app:checkslastatus')->everyFiveSeconds();
Schedule::command('app:generate-daily-report')->everyFiveSeconds();
Schedule::command('app:leader-daily-performance-report')->everyFiveSeconds();
Schedule::command('app:ticket-report-command')->everyFiveSeconds();;
Schedule::command('app:customer-report-command')->everyFiveSeconds();
Schedule::command('app:sla-report-command')->everyFiveSeconds();
Schedule::command('app:agent-report-command')->everyFiveSeconds();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
