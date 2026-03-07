@extends('layouts.app')

@section('content')

<div class="container-fl" style="height:100%;">
    <div class="row justify-content-center align-items-center" style="min-height:80vh;margin:0px;height:100%;">
        <!-- left column: mission/vision slider -->
        <div class="col-md-9 d-none d-md-block">
            <div id="missionVisionCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="6000">
                <div class="carousel-inner text-center p-4" style="background:#f8f9fa; border-radius:8px;">
                    <div class="carousel-item active">
                        <h2>Mission</h2>
                        <p>To provide accessible, reliable</p>
                    </div>
                    <div class="carousel-item">
                        <h2>Our Vision</h2>
                        <p>Be the leading cooperative recognised for innovation, transparency, and member satisfaction.</p>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#missionVisionCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#missionVisionCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <!-- right column: login form -->
        <div class="col-md-3" style="height: 100%;background:#fff;display: flex;">
            <div class="side-form">
                <div class="text-center mb-4">
                    <img class="main-logo" src="img/logo/SRSCC-LOGO.png" alt="" width="200px"/>
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-center mb-3">Login Form</h3>
                        <form id="loginForm" method="post" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">LOGIN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
