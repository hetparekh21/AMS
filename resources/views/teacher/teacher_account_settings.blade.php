@extends('layouts.content')

@section('nav-components')
@push('title')
    <title>Teacher Account Settings</title>
@endpush

@push('menu-items')
    <x-menu_item link="{{route('teacher.dashboard')}}" name="Dashboard" icon="bx-home-circle" active="" />
    <x-menu_item link="{{route('teacher.class')}}" name="Class" icon="bx-book-open" active="" />
    <x-menu_item link="" name="Attendance" icon="bx-edit-alt me-1" active="" />
    <x-menu_item link="{{route('teacher.account')}}" name="Account Settings" icon="bx-user" active="active" />
    <x-menu_item link="{{route('logout')}}" name="Logout" icon="bx-log-out or power-off" active="" />
@endpush

@endsection


@section('main-body')

@php

echo QrCode::size(300)->generate('ABCDE');

@endphp

@endsection