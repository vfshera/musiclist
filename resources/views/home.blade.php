@extends('layouts.master')

@section('content')
<master :user="{{ Auth::user() }}"><master/>
@endsection
