@push('title')
    <title>Admin Dashboard</title>
@endpush

@push('menu-items')
    <x-menu_item link="{{route('admin.dashboard')}}" name="Dashboard" icon="bx-home-circle" active="active" />
    <x-menu_item link="{{ route('teacher.attendance') }}" name="Attendance" icon="bx-edit-alt me-1" active="" />
    <x-menu_item link="{{route('logout')}}" name="Logout" icon="bx-log-out or power-off" active="" />
@endpush

@include('layouts.header')

@include('layouts.footer')