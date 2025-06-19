@extends('layouts.app')

@section('title', 'Our Services')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Our Services</h1>
            <p class="lead text-muted">Comprehensive digital solutions for healthcare management</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-calendar-check fs-1 text-primary mb-3"></i>
                        <h5 class="card-title fw-semibold">Smart Appointment Scheduling</h5>
                        <p class="card-text">
                            Intelligent appointment management using greedy and AI algorithms for optimal time-slot utilization.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-graph-up-arrow fs-1 text-success mb-3"></i>
                        <h5 class="card-title fw-semibold">Performance Metrics</h5>
                        <p class="card-text">
                            Analyze doctor efficiency, patient satisfaction, and scheduling effectiveness in real-time.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-person-lines-fill fs-1 text-info mb-3"></i>
                        <h5 class="card-title fw-semibold">Role-based Access</h5>
                        <p class="card-text">
                            Seamless experience for admins, doctors, and patients with personalized dashboards and features.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-bar-chart-line fs-1 text-warning mb-3"></i>
                        <h5 class="card-title fw-semibold">Reports & Analytics</h5>
                        <p class="card-text">
                            Generate and export insightful reports for appointments, performance, and algorithm comparisons.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-bell fs-1 text-danger mb-3"></i>
                        <h5 class="card-title fw-semibold">Real-time Notifications</h5>
                        <p class="card-text">
                            Instant alerts and updates for appointments, schedule changes, and important activities.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-shield-lock fs-1 text-dark mb-3"></i>
                        <h5 class="card-title fw-semibold">Secure Data Management</h5>
                        <p class="card-text">
                            Fully encrypted patient records and role-based permission systems to protect sensitive data.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('contact') }}" class="btn btn-outline-primary">Request a Demo</a>
        </div>
    </div>
@endsection
