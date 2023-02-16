<x-menu_item link="{{ route('teacher.dashboard') }}" name="Dashboard" icon="bxs-dashboard" active="{{$dashboard}}" />
<x-menu_item link="{{ route('teacher.class') }}" name="Class" icon="bx-book-open" active="{{$class}}" />
<x-menu_item link="{{ route('teacher.attendance') }}" name="Attendance" icon="bx-edit-alt me-1" active="{{$attendance}}" />
<x-menu_item link="{{ route('teacher.subject') }}" name="Subject" icon="bx-book" active="{{$subject}}" />
<x-menu_item link="{{ route('teacher.student') }}" name="Student" icon="bx-user" active="{{$student}}" />
<x-menu_item link="{{ route('logout') }}" name="Logout" icon="bx-log-out or power-off" active="" />
