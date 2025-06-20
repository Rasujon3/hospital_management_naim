@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow rounded">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Reset Password</h4>
                    </div>

                    <div class="card-body">
                        @include('partials.alerts')

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <!-- Hidden Token -->
                            <input type="hidden" name="token" value="{{ $token }}">

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email', request()->email) }}"
                                    required
                                    class="form-control @error('email') is-invalid @enderror"
                                >
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    required
                                    class="form-control @error('password') is-invalid @enderror"
                                >
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    required
                                    class="form-control"
                                >
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">
                                    Reset Password
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer text-center">
                        <a href="{{ route('login') }}">Back to Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
