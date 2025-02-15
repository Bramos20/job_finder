<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\JobAlert;
use App\Models\Job;
use App\Mail\JobAlertEmail;
use Illuminate\Support\Facades\Mail;

class SendJobAlerts extends Command
{
    protected $signature = 'job-alerts:send';
    protected $description = 'Send job alert emails to subscribed users';

    public function handle()
    {
        $alerts = JobAlert::all();

        foreach ($alerts as $alert) {
            $jobs = Job::where('category', $alert->category)
                        ->where('created_at', '>=', now()->subDay())
                        ->get();

            if ($jobs->isNotEmpty()) {
                Mail::to($alert->email)->send(new JobAlertEmail($jobs));
            }
        }

        $this->info('Job alert emails sent successfully!');
    }
}

