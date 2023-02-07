@push('title')
    <title>Admin Dashboard</title>
@endpush

@push('menu-items')
    <x-admin_menu_items dashboard="active" attendance="" subject="" />
@endpush

@include('layouts.header')

@include('layouts.footer')