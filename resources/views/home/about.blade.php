@extends('layouts.app')

@section('title', 'About Us')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold">About MediSync Solutions</h1>
            <p class="lead text-muted">Transforming Healthcare Management with Innovation and Technology</p>
        </div>

        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="https://source.unsplash.com/600x400/?hospital,technology" alt="Healthcare Technology" class="img-fluid rounded shadow-sm">
            </div>
            <div class="col-md-6">
                <h4 class="fw-semibold">Our Mission</h4>
                <p>
                    MediSync Solutions is dedicated to digitizing healthcare processes and improving patient outcomes
                    through efficient hospital and clinic management. From smart appointment booking to analytics-driven
                    decision making, our platform offers an end-to-end solution for healthcare providers.
                </p>

                <h4 class="fw-semibold mt-4">Why Choose Us?</h4>
                <ul class="list-unstyled">
                    <li><i class="bi bi-check-circle text-success me-2"></i>AI-powered appointment scheduling</li>
                    <li><i class="bi bi-check-circle text-success me-2"></i>Real-time conflict detection and resolution</li>
                    <li><i class="bi bi-check-circle text-success me-2"></i>Role-based dashboards for admins, doctors & patients</li>
                    <li><i class="bi bi-check-circle text-success me-2"></i>Advanced analytics and performance reports</li>
                </ul>
            </div>
        </div>

        <div class="mt-5 text-center">
            <a href="{{ route('contact') }}" class="btn btn-primary">Contact Us</a>
        </div>
    </div>
@endsection
