@extends('layouts.adminAuth')

@section('content')


<h4 class="mb-2">مرحبا بك في مبيعات 👋</h4>
<p class="mb-4">قم بادارة مبيعاتك بكل يسر وسهولة مع مبيعات</p>

<form id="formAuthentication" class="mb-3" action="{{ route('backend.login') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">الايميل</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror()" id="email" name="email"
            placeholder="" autofocus />

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="mb-3 form-password-toggle">
        <div class="d-flex justify-content-between">
            <label class="form-label" for="password">كلمة المرور</label>
            {{-- <a href="auth-forgot-password-basic.html">
                <small>Forgot Password?</small>
            </a> --}}
        </div>

        <div class="input-group input-group-merge">
            <input type="password" id="password" name="password"
                class="form-control @error('password') is-invalid @enderror()"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="password" />

            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" name="remember" type="checkbox" id="remember-me" />
            <label class="form-check-label" for="remember-me"> تذكرني </label>
        </div>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary d-grid w-100" type="submit">تسجيل الدخول</button>
    </div>
</form>

{{-- <p class="text-center">
    <span>New on our platform?</span>
    <a href="auth-register-basic.html">
        <span>Create an account</span>
    </a>
</p> --}}

@endsection