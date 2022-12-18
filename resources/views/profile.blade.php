@extends('dashboard.app', ['title' => 'Profile'])

@section('body')
<div class="main-wrapper">
    <div class="account-page">
        <div class="account-box">
            <div class="card-title fw-bold fs-5">Profile Management</div>
            <div>
                <div class="form-group">
                    <label>Name</label>
                    <x-jet-input id="name" class="form-control" type="name" name="name" value="{{Auth::user()->name}}"/>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <x-jet-input id="username" class="form-control" type="username" name="username" value="{{Auth::user()->username}}"/>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <x-jet-input id="email" class="form-control" type="email" name="email" value="{{Auth::user()->email}}"/>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" onclick="$(this).editProfile()">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-wrapper mt-5">
    <div class="account-page">
        <div class="account-box">
            <div class="card-title fw-bold fs-5">Password Management</div>
            <div>
                <div class="form-group">
                    <label>New Password</label>
                    <x-jet-input id="new-password" class="form-control" type="password" name="new-password" />
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <x-jet-input id="confirm-password" class="form-control" type="password" name="confirm-password" />
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" onclick="$(this).editPassword()">Save</button>
                    <div class="text-danger mt-3" id='error' name='error'></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    @include('js')
@endsection