<x-menu_item link="{{ route('admin.dashboard') }}" name="Dashboard" icon="bx-home-circle" active="{{$dashboard}}" />
<x-menu_item link="{{ route('teacher.attendance') }}" name="Attendance" icon="bx-edit-alt me-1" active="{{$attendance}}" />
<x-menu_item link="{{ route('admin.course') }}" name="Course" icon="bx-book-content" active="{{$course}}" />
<x-menu_item link="{{ route('admin.subject') }}" name="Subject" icon="bx-book" active="{{$subject}}" />
<x-menu_item link="{{ route('admin.teacher') }}" name="Teacher" icon="bx-user" active="{{$teacher}}" />
<x-menu_item link="{{ route('admin.student') }}" name="Student" icon="bx-group" active="{{$student}}" />
<x-menu_item link="{{ route('logout') }}" name="Logout" icon="bx-log-out or power-off" active="" />
