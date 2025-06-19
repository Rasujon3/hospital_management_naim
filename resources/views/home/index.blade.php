@extends('layouts.app')

@section('title', 'Welcome to MediSync Solutions')

@section('content')
    <div class="container py-5">
        {{-- Hero Section --}}
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold">Welcome to MediSync Solutions</h1>
            <p class="lead">Your all-in-one hospital and clinic management system for seamless healthcare operations.</p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg mt-3">Get Started</a>
        </div>

        {{-- Features Section --}}
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-calendar-check fs-2 text-primary mb-3"></i>
                        <h5 class="card-title">Smart Appointment</h5>
                        <p class="card-text">Book, reschedule or cancel appointments with AI-powered and real-time scheduling features.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-person-badge fs-2 text-success mb-3"></i>
                        <h5 class="card-title">Role-Based Access</h5>
                        <p class="card-text">Admins, doctors, and patients each have their own dedicated dashboard and permissions.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-bar-chart-line fs-2 text-warning mb-3"></i>
                        <h5 class="card-title">Analytics & Reports</h5>
                        <p class="card-text">Track system metrics, compare scheduling algorithms, and export detailed reports.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Call to Action --}}
        <div class="text-center mt-5">
            <p class="lead">Already have an account?</p>
            <a href="{{ route('login') }}" class="btn btn-outline-secondary">Login Now</a>
        </div>
    </div>
@endsection
