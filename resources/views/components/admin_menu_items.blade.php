<x-menu_item link="{{ route('admin.dashboard') }}" name="Dashboard" icon="bx-home-circle" active="{{$dashboard}}" />
<x-menu_item link="{{ route('teacher.attendance') }}" name="Attendance" icon="bx-edit-alt me-1" active="{{$attendance}}" />
<x-menu_item link="{{ route('logout') }}" name="Logout" icon="bx-log-out or power-off" active="" />
