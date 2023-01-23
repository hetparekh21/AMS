@extends('layouts.content')

@section('nav-components')
@push('title')
    <title>Attendance</title>
@endpush

@push('menu-items')
    <x-menu_item link="{{route('teacher.dashboard')}}" name="Export Excel" icon="bxs-file-export" active="" />
    <x-menu_item link="{{route('teacher.class')}}" name="Class" icon="bx-book-open" active="" />
    <x-menu_item link="{{route('teacher.account')}}" name="Account Settings" icon="bx-user" active="" />
    {{-- <x-menu_item link="{{route('attendance')}}" name="Attendance" icon="bx-calendar" active="active" /> --}}
@endpush

@endsection

