<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Jobs\PruneOldPostsJob;
use App\Models\Post;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

 
// $schedule->job(new PruneOldPostsJob($post))->dailyAt('00:00');
// WHAT SHOULD I PASS TO THE JOB ?