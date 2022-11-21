<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title text-center pt-4">Navigate</li>
                <li>
                    <a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                </li>
                @hasrole('admin')
                <li>
                    <a href="{{ url('admin/songs') }}"><i class="fa fa-dashboard"></i> <span>Songs</span></a>
                </li>
                @endhasrole
{{--                <li class="submenu">--}}
{{--                    <a href="#"><i class="fa fa-user"></i> <span> Employees </span> <span class="menu-arrow"></span></a>--}}
{{--                    <ul style="display: none;">--}}
{{--                        <li><a href="employees.html">Employees List</a></li>--}}
{{--                        <li><a href="leave.html">Leaves</a></li>--}}
{{--                        <li><a href="holidays.html">Holidays</a></li>--}}
{{--                        <li><a href="attendance.html">Attendance</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
            </ul>
        </div>
    </div>
</div>
