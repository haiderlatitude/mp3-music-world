<!DOCTYPE html>
<html lang="en">

@include('dashboard.head', ['title' => "Login"])

<body>
<div class="main-wrapper account-wrapper">
    <div class="account-page">
        <div class="account-center">
            <div class="account-box">
                <form action="{{ route('login') }}" method="post" class="form-signin">
                    @csrf
                    <div class="account-logo">
                        <a href="{{ url('login') }}"><img src="{{ asset('logo.png') }}" alt="account-logo"></a>
                    </div>
                    @if(session('message'))
                        <div>{{ session('message') }}</div>
                    @endif
                    <x-jet-validation-errors class="alert alert-danger alert-dismissible fade show" />
                    <div class="form-group">
                        <label>Username or Email</label>
                        <x-jet-input id="login" class="form-control" type="login" name="login" :value="old('login')"
                                     required autofocus/>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <x-jet-input id="password" class="form-control" type="password" name="password" required
                                     autocomplete="current-password"/>
                    </div>
                    
                    <div class="form-group text-right">
                        @if (Route::has('password.request'))
                            <a class="form-group  text-right"
                               href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                    <div class="form-group text-center">
                        <x-jet-button class="btn btn-primary account-btn">
                            {{ __('Log in') }}
                        </x-jet-button>
                    </div>
                    <div class="text-center register-link">
                        Don’t have an account? <a href="{{ route('register') }}">Register Now</a>
                    </div>
                </form>
            </div>
        </div>
</div>

</body>
</html>

