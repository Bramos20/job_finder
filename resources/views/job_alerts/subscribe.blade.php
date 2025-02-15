@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Subscribe to Job Alerts</h2>
    <form action="{{ route('job-alerts.subscribe') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Job Category:</label>
            <select name="category" class="form-control">
                <option value="">All Categories</option>
                <option value="developer">Developer</option>
                <option value="designer">Designer</option>
                <option value="writer">Writer</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Subscribe</button>
    </form>
</div>
@endsection
