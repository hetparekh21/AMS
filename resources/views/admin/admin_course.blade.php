@extends('layouts.content')

@section('nav-components')
    @push('title')
        <title>Admin Dashboard</title>
    @endpush

    @push('menu-items')
        <x-admin_menu_items dashboard="" attendance="" subject="" course="active" />
    @endpush
@endsection

@section('main-body')


    <div class="row">

        <div class="col-12 col-lg-8 order-2 mb-4">

            <button type="button" class="btn rounded-pill btn-outline-primary" id="add_course" onclick="get_course(this.id)"
                data-bs-toggle="modal" data-bs-target="#course_modal">
                <span class="tf-icons bx bx-plus"></span>&nbsp;Course
            </button>

        </div>

    </div>

    <div class="row">

        @foreach ($courses as $data)
            <div class="col-md-4 order-1 order-md-1 order-lg-1 mb-4">
                <div class="card">
                    <div class="d-flex align-items-end row">

                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $data['course_name'] }}</h5>
                            <p class="mb-4">
                                Course Code : <span class="fw-bold">{{ $data['course_code'] }}</span> <br>
                                Semesters : <span class="fw-bold">{{ $data['semesters'] }}</span>
                            </p>

                            <a href="{{route('course.manage',$data['course_id'])}}" class="btn btn-sm btn-outline-primary">Manage <span
                                    class="tf-icons bx bx-chevron-right"></span></a>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection

@section('right-side-panel')
    <div class="modal fade" id='course_modal' tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="exampleModalLabel1">Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('course.create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="course_name" class="form-label">Course Name</label>
                            <input type="text" class="form-control" id="course_name" value="{{old('course_name')}}" name="course_name" required>
                            @error('course_name')
                                <span class="text-danger">Course Name Required</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="course_code" class="form-label">Course Code</label>
                            <input type="text" class="form-control" id="course_code" value="{{old('course_code')}}" name="course_code" required>
                            @error('course_code')
                                <span class="text-danger">Course Code Required</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="course_description" class="form-label">Semesters</label>
                            <input type="number" class="form-control" id="semesters" min="1" max="10"
                                value="1" value="{{old('semesters')}}" name="semesters" required>
                            @error('semesters')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Create Course</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // check if there are errors in the class initiate form and open it
    @if ($errors->has('course_name') || $errors->has('course_code') || $errors->has('semesters'))
        var class_button = document.getElementById('add_course');
        class_button.click();
    @endif
</script>

@if(session('notification'))

    @php
        $notification = session('notification');
    @endphp

    <div class="bs-toast toast toast-placement-ex m-2 fade bg-{{$notification[0]}} top-0 end-0" role="alert" aria-live="assertive"
        aria-atomic="true">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">{{$notification[0]}}</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">{{$notification[1]}}</div>
    </div>

    <script>
        $(function() {
            $('.toast').toast('show');
        });
    </script>
@endif

@endsection
