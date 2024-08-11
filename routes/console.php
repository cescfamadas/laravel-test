<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use App\Mail\PostCountMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

/*app(Schedule::class)->call(function () {
    Mail::to('admin@example.com')->send(new PostCountMail());
})->everyMinute();
*/