<x-menu_item link="{{ route('teacher.dashboard') }}" name="Dashboard" icon="bx-home-circle" active="{{$dashboard}}" />
<x-menu_item link="{{ route('teacher.class') }}" name="Class" icon="bx-book-open" active="{{$class}}" />
<x-menu_item link="{{ route('teacher.attendance') }}" name="Attendance" icon="bx-edit-alt me-1" active="{{$attendance}}" />
<x-menu_item link="{{ route('teacher.account') }}" name="Account Settings" icon="bx-user" active="{{$account}}" />
<x-menu_item link="{{ route('logout') }}" name="Logout" icon="bx-log-out or power-off" active="" />
