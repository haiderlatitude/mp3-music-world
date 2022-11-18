<div class="header">
    <div class="header-left">
        <a href="index-2.html" class="logo">
            <img src="assets/img/logo.png" width="35" height="35" alt=""> <span>MP3 Music World</span>
        </a>
    </div>
    <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
    <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
    <ul class="nav user-menu float-end">

        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link user-link"
               id="dropdownPofile" data-bs-toggle="dropdown" aria-expanded="false">
                {{--                        <span class="user-img"><img class="rounded-circle" src="#" width="40" alt="user image">--}}
                {{--							<span class="status online"></span>--}}
                {{--                </span>--}}
                <span>Admin</span>
            </a>
            <div class="dropdown-menu" id="menu" aria-labelledby="dropdownProfile">
                <a class="dropdown-item" href="profile.html">My Profile</a>
                <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                <a class="dropdown-item" href="settings.html">Settings</a>
                <form method="POST" id="logout" action="{{ route('logout') }}" x-data>
                    @csrf
                    <a class="dropdown-item" style="cursor: pointer" onclick="logout()">
                        Logout
                    </a>
                </form>
            </div>
        </li>
    </ul>
    <div class="dropdown mobile-user-menu float-end">
        <a href="#" class="nav-link dropdown-toggle" id="dropdownPofile" data-bs-toggle="dropdown"
           aria-expanded="false"><i
                class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right" id="menu" aria-labelledby="dropdownProfile">
            <a class="dropdown-item" href="profile.html">My Profile</a>
            <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
            <a class="dropdown-item" href="settings.html">Settings</a>
            <form method="POST" id="logout" action="{{ route('logout') }}" x-data>
                @csrf
                <a class="dropdown-item" style="cursor: pointer" onclick="logout()">
                    Logout
                </a>
            </form>
        </div>
    </div>
</div>
