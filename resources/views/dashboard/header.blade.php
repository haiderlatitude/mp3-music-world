<div class="header">
    <div class="header-left">
        <a href="dashboard" class="logo">
            <img src="{{asset('logo.png')}}" width="35" height="35" alt="Main Logo"> <span>MP3 Music World</span>
        </a>
    </div>
    <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
    <ul class="nav user-menu float-end">

        <li class="nav-item dropdown">
            <a href="#" class="dropdown-toggle nav-link user-link"
               id="dropdownPofile" data-bs-toggle="dropdown" aria-expanded="false">
                @if(auth()->check())<span>{{Auth::user()->name}}</span> @else
                    <span>User</span>
                @endif
            </a>
{{--            <div class="dropdown-menu" id="menu" aria-labelledby="dropdownProfile">--}}
{{--                <a class="dropdown-item" href="profile.html">My Profile</a>--}}
{{--                <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>--}}
{{--                <a class="dropdown-item" href="settings.html">Settings</a>--}}
{{--                <form method="POST" id="logout" action="{{ route('logout') }}" x-data>--}}
{{--                    @csrf--}}
{{--                    <a class="dropdown-item" style="cursor: pointer" onclick="logout()">--}}
{{--                        Logout--}}
{{--                    </a>--}}
{{--                </form>--}}
{{--            </div>--}}
        </li>
    </ul>
</div>
