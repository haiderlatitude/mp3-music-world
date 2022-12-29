<!DOCTYPE html>
<html lang="en">

@include('dashboard.head', ['title' => "Forgot Password"])

<body>
    <div class="main-wrapper  account-wrapper">
        <div class="account-page">
            <div class="account-center">
                <div class="account-box">

                <div class="mb-4 text-sm text-gray-600">
                {{ __('Enter your email address so we can send you a password reset link.') }}
                </div>
        
        <x-jet-validation-errors class="text-danger mb-4"/>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <x-jet-label for="email" value="{{ __('Email') }}"/>
                <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')"
                             required autofocus/>
            </div>

            <div class="form-group text-center mt-3">
                <x-jet-button class='btn btn-primary'>
                    {{ __('Email Link') }}
                </x-jet-button>
            </div>
        </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
