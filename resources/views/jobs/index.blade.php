@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Remote Job Listings</h1>

    {{-- Filter Form --}}
    <form method="GET" action="{{ url('/jobs') }}" class="mb-4">
        <div class="row">
            <div class="col-md-2">
                <input type="text" name="title" class="form-control" placeholder="Job Title" value="{{ request('title') }}">
            </div>
            <div class="col-md-2">
                <input type="text" name="company" class="form-control" placeholder="Company Name" value="{{ request('company') }}">
            </div>
            <div class="col-md-2">
                <input type="date" name="date" class="form-control" value="{{ request('date') }}">
            </div>
            <div class="col-md-2">
                <select name="category" class="form-control">
                    <option value="">All Categories</option>
                    <option value="developer" {{ request('category') == 'developer' ? 'selected' : '' }}>Developer</option>
                    <option value="designer" {{ request('category') == 'designer' ? 'selected' : '' }}>Designer</option>
                    <option value="writer" {{ request('category') == 'writer' ? 'selected' : '' }}>Writer</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="min_salary" class="form-control" placeholder="Min Salary" value="{{ request('min_salary') }}">
            </div>
            <div class="col-md-2">
                <input type="number" name="max_salary" class="form-control" placeholder="Max Salary" value="{{ request('max_salary') }}">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-3">
                <select name="sort" class="form-control">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ url('/jobs') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    {{-- Job Listings Table --}}
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Company</th>
                <th>Category</th>
                <th>Salary</th>
                <th>Link</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jobs as $job)
                <tr>
                    <td>{{ $job->title }}</td>
                    <td>{{ $job->company }}</td>
                    <td>{{ ucfirst($job->category) }}</td>
                    <td>${{ number_format($job->salary, 2) }}</td>
                    <td><a href="{{ $job->link }}" target="_blank">View Job</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination Links --}}
    {{ $jobs->links('pagination::bootstrap-4') }}
</div>
@endsection


{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Remote Job Listings</h1>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Company</th>
                <th>Link</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jobs as $job)
                <tr>
                    <td>{{ $job->title }}</td>
                    <td>{{ $job->company }}</td>
                    <td><a href="{{ $job->link }}" target="_blank">View Job</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    
    {{ $jobs->links('pagination::bootstrap-4') }}
</div>
@endsection --}}
