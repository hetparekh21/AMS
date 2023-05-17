@if (session('notification'))
    @php
        $notification = session('notification');
    @endphp

    <div class="bs-toast toast toast-placement-ex m-2 fade bg-{{ $notification[0] }} top-0 end-0" role="alert"
        aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">{{ $notification[0] }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">{{ $notification[1] }}</div>
    </div>

    <script>
        $(function() {
            $('.toast').toast('show');
        });
    </script>
@endif
