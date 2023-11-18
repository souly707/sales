@extends('layouts.adminAuth')

@section('title', 'Register Page')


@section('content')
<h4 class="mb-2">Adventure starts here 🚀</h4>
<p class="mb-4">Make your app management easy and fun!</p>

<form id="formAuthentication" class="mb-3" action="" method="POST">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="username" name="name"
            placeholder="Enter your Name" value="{{ old('name') }}" autofocus autocomplete="name" />

        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror()" id="email" name="email"
            placeholder="Enter your email" value="{{ old('email') }}" autocomplete="email" />

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="mb-3 form-password-toggle">
        <label class="form-label" for="password">Password</label>
        <div class="input-group input-group-merge">
            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="password" autocomplete="new-password" />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    {{-- <div class="mb-3 form-password-toggle">
        <label class="form-label" for="password_confirmation">Confirm Password</label>
        <div class="input-group input-group-merge">
            <input type="password" id="password"
                class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="password_confirmation" autocomplete="new-password" />
            <span class=" input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>

        @error('password_confirmation')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div> --}}

    {{-- <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
            <label class="form-check-label" for="terms-conditions">
                I agree to
                <a href="javascript:void(0);">privacy policy & terms</a>
            </label>
        </div>
    </div> --}}
    <button class="btn btn-primary d-grid w-100">Sign up</button>
</form>

<p class="text-center">
    <span>Already have an account?</span>
    <a href="">
        <span>Sign in instead</span>
    </a>
</p>
@endsection