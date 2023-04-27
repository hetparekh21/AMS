@extends('layouts.content')

@section('nav-components')
    @push('title')
        <title>Admin Dashboard</title>
    @endpush

    @push('menu-items')
        <x-admin_menu_items dashboard="active" attendance="" subject="" course="" />
    @endpush
@endsection

@section('main-body')
    
@endsection
