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
    <h2>{{ $receiverName ?? 'Frank' }} , Thanks For Contacting us</h2>
    <p>We Will Reach Back To You Soon</p>
    <h4>TOTT</h4>
</div>
@endsection
