<?php

namespace App\Services;

use App\Models\Job;

class JobScraperService
{
    public function scrapeJobs()
    {
        $output = shell_exec('node scripts/jobScraper.js');
        $jobs = json_decode($output, true);

        if (!is_array($jobs)) {
            throw new \Exception("Invalid JSON from scraper: " . $output);
        }

        foreach ($jobs as $job) {
            Job::updateOrCreate(
                ['link' => $job['link']],  // Prevent duplicates based on the link
                ['title' => $job['title'], 'company' => $job['company']]
            );
        }

        return $jobs; // Return the jobs if needed
    }
}
