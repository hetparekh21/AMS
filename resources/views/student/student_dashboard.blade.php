@push('title')
    <title>Student Dashboard</title>
@endpush

@push('menu-items')
    <x-menu_item link="{{route('student.dashboard')}}" name="Dashboard" icon="bx-home-circle" active="active" />
    <x-menu_item link="{{route('logout')}}" name="Logout" icon="bx-log-out or power-off" active="" />
@endpush

@include('header')


@include('footer')