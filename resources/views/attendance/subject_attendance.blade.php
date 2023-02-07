@extends('layouts.content')

@section('nav-components')
    @push('title')
        <title>Subject Attendance</title>
    @endpush

    @push('menu-items')
        @if ($user_role != 1)
            <x-teacher_menu_items dashboard="" class="" attendance="" subject="active" />
        @else
            <x-admin_menu_items dashboard="" attendance="" subject ="active" />
        @endif
    @endpush
@endsection

@section('main-body')
    <div class="row">
        
    </div>
@endsection

@section('right-side-panel')
@endsection

@section('scripts')
@endsection
