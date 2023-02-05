@method('dashboard')

@yield('nav-components')

@include('layouts.header')

<div class="container-xxl flex-grow-1 container-p-y h-100">

    @yield('main-body')

    @yield('right-side-panel')

</div>

@include('layouts.footer')

@yield('scripts')
