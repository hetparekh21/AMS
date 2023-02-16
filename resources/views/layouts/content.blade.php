@yield('nav-components')

<?php $user_details = user_info(); ?>

@push('name')
    <?php echo $user_details[0]; ?>
@endpush

@push('role')
    <?php echo $user_details[1]; ?>
@endpush

@include('layouts.header')

<div class="container-xxl flex-grow-1 container-p-y h-100">

    @yield('main-body')

    @yield('right-side-panel')

</div>

@include('layouts.footer')

@yield('scripts')
