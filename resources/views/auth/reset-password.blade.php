@extends('dashboard.app', ['title' => 'Reset Password'])

@section('body')
    <div class="main-wrapper mt-5">
        <div class="account-page">
            <div class="account-box">
                <div class="card-title fw-bold fs-5">Reset Password</div>
                <x-jet-validation-errors class="alert alert-danger alert-dismissible fade show"/>
                <div>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="form-group">
                            <label>Email</label>
                            <x-jet-input id="email" class="form-control" type="text" name="email" :value="old('email', $request->email)" required/>
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <x-jet-input id="new-password" class="form-control" type="password" name="password"
                                         required/>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <x-jet-input id="confirm-password" class="form-control" type="password"
                                         name="password_confirmation" required/>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Reset
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
