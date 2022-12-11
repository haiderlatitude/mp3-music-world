<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <br>
                <br>
                @hasrole(\App\Utils\Roles::$ADMIN)

                <li class="menu-title text-center pt-4">Management</li>
                {{--                <li>--}}
                {{--                    <a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>--}}
                {{--                </li>--}}

                <li>
                    <a href="{{ url('admin/songs') }}"><i class="fa fa-dashboard"></i> <span>Songs</span></a>
                </li>
                <li>
                    <a href="{{ route('songs.create') }}"><i class="fa fa-dashboard"></i> <span>Upload a Song</span></a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}"><i class="fa fa-dashboard"></i> <span>Users</span></a>
                </li>
                <li>
                    <a href="{{ route('artists.index') }}"><i class="fa fa-dashboard"></i> <span>Artists</span></a>
                </li>
                <li>
                    <a href="{{ route('artists.create') }}"><i class="fa fa-dashboard"></i> <span>Add Artist</span></a>
                </li>
                <hr>
                @endhasrole



                @if(auth()->check())
                    <li>
                        <a href="{{ route('users.index') }}"><i class="fa fa-dashboard"></i> <span>Profile</span></a>
                    </li>
                    <form method="POST" id="logout" action="{{ route('logout') }}" x-data>
                        @csrf
                        <li>
                            <button onclick="logout()" class="btn btn-primary"><i class="fa fa-dashboard"></i> <span>Logout</span></button>
                        </li>

                    </form>
                @else

                    <li>
                        <a href="{{ route('login') }}"><i class="fa fa-dashboard"></i> <span>Login</span></a>
                    </li>

                @endif

                {{--                <li>--}}
                {{--                    <a href="{{ url('#') }}"><i class="fa fa-dashboard"></i> <span>Create Playlist</span></a>--}}
                {{--                </li>--}}

            </ul>
        </div>
    </div>
</div>
