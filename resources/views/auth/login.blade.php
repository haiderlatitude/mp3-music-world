
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
                        <a href="{{ url('/') }}"><img src="#" alt="account-logo"></a>
                    </div>
                    <x-jet-validation-errors class="alert alert-danger alert-dismissible fade show" />
                    <div class="form-group">
                        <label>Username or Email</label>
                        <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')"
                                     required autofocus/>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <x-jet-input id="password" class="form-control" type="password" name="password" required
                                     autocomplete="current-password"/>
                    </div>
                    <div class="form-group  text-right">
                        <label for="remember_me" class=" text-right">
                            <x-jet-checkbox id="remember_me" name="remember"/>
                            <span class=" text-right">{{ __('Remember me') }}</span>
                        </label>
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
<div class="sidebar-overlay" data-reff=""></div>
@include('dashboard.js')
</body>
</html>

