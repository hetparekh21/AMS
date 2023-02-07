@extends('layouts.content')

@section('nav-components')
    @push('title')
        <title>Teacher Account Settings</title>
    @endpush

    @push('menu-items')
        <x-teacher_menu_items dashboard="" class="" attendance="" subject="active" />
    @endpush
@endsection


@section('main-body')
    @php
        
        echo QrCode::size(300)->generate('ABCDE');
        
    @endphp
@endsection
