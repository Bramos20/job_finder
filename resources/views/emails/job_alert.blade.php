@extends('layouts.app')

@section('content')
    <h2>New Job Listings in Your Category</h2>
    <ul>
        @foreach ($jobs as $job)
            <li>
                <strong>{{ $job['title'] }}</strong> at {{ $job['company'] }} - 
                <a href="{{ $job['link'] }}" target="_blank">Apply Now</a>
            </li>
        @endforeach
    </ul>
@endsection

