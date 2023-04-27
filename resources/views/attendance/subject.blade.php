@extends('layouts.content')

@section('nav-components')
    @push('title')
        <title>Subject</title>
    @endpush

    @push('menu-items')
        @if ($user_role != 1)
            <x-teacher_menu_items dashboard="" class="" attendance="" subject="active" student="" />
        @else
            <x-admin_menu_items dashboard="" attendance="" subject="active" course="" />
        @endif
    @endpush
@endsection

@section('main-body')
    <div class="row">

        @foreach ($subjects as $data)
            <div class="col-md-4 order-1 order-md-1 order-lg-1 mb-4">
                <div class="card">
                    <div class="d-flex align-items-end row">

                        <div class="card-body">
                            <h5 class="card-title text-primary">{{$data['subject_name']}}</h5>
                            <p class="mb-4">
                                Course :<span class="fw-bold">{{$data['course_name']}}</span> <br>
                                Sem : <span class="fw-bold">{{$data['semester_name']}}</span>
                            </p>

                            <a href="{{route('attendance.subject',$data['subject_id'])}}" class="btn btn-sm btn-outline-primary">View Attendance</a>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection

@section('right-side-panel')
@endsection

@section('scripts')
@endsection
