<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <br>
                <br>

                <li class="menu-title text-center">Management</li><hr>
                @auth
                    <li>
                        <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                    </li>
                    <li>
                        <a href="{{ route('profile.show') }}"><i class="fa fa-user"></i> <span>Profile</span></a>
                    </li>
                    <hr>
                @endauth
                @hasrole(\App\Utils\Roles::$ADMIN)
                <li>
                    <a href="{{ url('admin/songs') }}"><i class="fa fa-music"></i> <span>Songs</span></a>
                </li>
                <li>
                    <a href="{{ route('songs.create') }}"><i class="fa fa-music"></i> <span>Upload a Song</span></a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}"><i class="fa fa-user"></i> <span>Users</span></a>
                </li>
                <li>
                    <a href="{{ route('artists.index') }}"><i class="fa fa-microphone"></i> <span>Artists</span></a>
                </li>
                <li>
                    <a href="{{ route('artists.create') }}"><i class="fa fa-microphone"></i> <span>Add Artist</span></a>
                </li>
                <hr>
                @endhasrole


                @if(auth()->check())
                    <li>
                        <a href="{{ route('playlist.index') }}"><i class="fa fa-microphone"></i> <span>Playlists</span></a>
                    </li>
                    <hr>
                    <form method="POST" id="logout" action="{{ route('logout') }}" x-data>
                        @csrf
                        <div class="text-center">
                            <li>
                                <button onclick="logout()" class="btn btn-primary bg-danger">
                                    <i class="fa"></i>
                                    <span>Logout</span>
                                </button>
                            </li>
                        </div>
                    </form>
                @else

                    <li>
                        <a href="{{ route('login') }}"><i class="fa fa-user"></i> <span>Login</span></a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}"><i class="fa fa-user"></i> <span>Register</span></a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
