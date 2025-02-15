<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::query();

        // Filter by job title
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        // Filter by company
        if ($request->filled('company')) {
            $query->where('company', 'like', '%' . $request->company . '%');
        }

        // Filter by date posted
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by minimum salary
        if ($request->filled('min_salary')) {
            $query->where('salary', '>=', $request->min_salary);
        }

        // Filter by maximum salary
        if ($request->filled('max_salary')) {
            $query->where('salary', '<=', $request->max_salary);
        }

        // Sorting (Default: Newest First)
        if ($request->filled('sort')) {
            if ($request->sort === 'oldest') {
                $query->oldest();
            } else {
                $query->latest();
            }
        }

        $jobs = $query->latest()->paginate(10);

        return view('jobs.index', compact('jobs'));
    }
}
