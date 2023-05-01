@extends('layouts.auth')
@section('title', 'Login')
@section('content')
<div class="px-3 py-3">
    <div class="text-center">
        <h5 class="mb-0">Welcome Back !</h5>
        <p class="text-muted mt-2">Sign in to continue.</p>
    </div>
    <form class="mt-4 pt-2" method="post">
        @csrf
        <div class="form-floating form-floating-custom mb-3">
            <input type="text" class="form-control" id="input-username" name="email" placeholder="Enter Email Address">
            <label for="input-username">Email</label>
            <div class="form-floating-icon">
                <i class="uil uil-envelope-alt"></i>
            </div>
            @if($errors->has('email'))
                <span class="text-sm text-small text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="form-floating form-floating-custom mb-3 auth-pass-inputgroup">
            <input type="password" class="form-control" id="password-input" name="password" placeholder="Enter Password">
            <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
            </button>
            <label for="password-input">Password</label>
            <div class="form-floating-icon">
                <i class="uil uil-padlock"></i>
            </div>
        </div>
        <div class="form-check form-check-primary font-size-16 py-1">
            <input class="form-check-input" type="checkbox" name="remember" id="remember-check">
            <div class="float-end">
                <a href="/forgot" class="text-muted text-decoration-underline font-size-14">Forgot your password?</a>
            </div>
            <label class="form-check-label font-size-14" for="remember-check">
                Remember me
            </label>
        </div>

        {{-- @if($errors->any())
            @foreach ($errors->all() as $err)
                <div class="alert alert-danger">{{ $err }}</div>
            @endforeach
        @endif--}}
        <div class="mt-3">
            <button class="btn btn-primary w-100" type="submit">Log In</button>
        </div>

        <div class="mt-4 pt-3 text-center">
            <p class="text-muted mb-0">Don't have an account ? <a href="{{ route('staff.register') }}" class="fw-semibold text-decoration-underline"> Signup Now </a> </p>
        </div>

    </form><!-- end form -->
</div>
@endsection