<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title text-center pt-4">Management</li>
                <li>
                    <a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                </li>
                @hasrole(\App\Utils\Roles::$ADMIN)
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
                @endhasrole

            </ul>
        </div>
    </div>
</div>
