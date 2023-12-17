@extends('base')

@include('navbar')

@section('content')
<div class="container-fluid">
    <div class="container">
        <h1 class="text-center mt-5">Welcome to the Dashboard</h1>
        <p>This is your dashboard page where you can view and manage various aspects of your application.</p>
        <div class="alert alert-info" role="alert">
            Important information or updates can go here.
        </div>
    </div>
</div>
@endsection
