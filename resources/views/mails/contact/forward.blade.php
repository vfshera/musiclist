@extends('layouts.mail')

@section('mail-styles')
    <style>
        .mail-body{
            display: flex;
            flex-direction: column;
            padding: 40px 80px;
            background: #5d8ee333;
            color: white;
            min-height: 90vh;
        }
    </style>
@endsection
@section('mail-body')
    <div class=" mail-body ">
        <h2>RE : {{ $subject ?? 'FORWARDED MAIL' }}</h2>
        <p>{{ $msg ?? 'Laravel is a web application framework with expressive, elegant syntax. We’ve already laid the foundation — freeing you to create without sweating the small things.'}}</p>
        <br><br>
        <h4>From </h4>
        <h5>{{ $name ?? 'Mail Test'}}</h5>
    </div>
@endsection
