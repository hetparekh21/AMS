@extends('layouts.content')

@section('nav-components')
    @push('title')
        <title>Attendance</title>
    @endpush

    @push('menu-items')
        @if ($user_role != 1)
            <x-menu_item link="{{ route('teacher.dashboard') }}" name="Dashboard" icon="bx-home-circle" active="" />
            <x-menu_item link="{{ route('teacher.class') }}" name="Class" icon="bx-book-open" active="" />
            <x-menu_item link="{{ route('teacher.attendance') }}" name="Attendance" icon="bx-edit-alt me-1" active="active" />
            <x-menu_item link="{{ route('teacher.account') }}" name="Account Settings" icon="bx-user" active="" />
            <x-menu_item link="{{ route('logout') }}" name="Logout" icon="bx-log-out or power-off" active="" />
        @else
            <x-menu_item link="{{ route('admin.dashboard') }}" name="Dashboard" icon="bx-home-circle" active="" />
            <x-menu_item link="{{ route('teacher.attendance') }}" name="Attendance" icon="bx-edit-alt me-1" active="active" />
            <x-menu_item link="{{ route('logout') }}" name="Logout" icon="bx-log-out or power-off" active="" />
        @endif
    @endpush
@endsection

@section('main-body')
@endsection


@section('scripts')
@endsection
