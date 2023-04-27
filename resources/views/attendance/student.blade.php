@extends('layouts.content')

@section('nav-components')
    @push('title')
        <title>Student</title>
    @endpush

    @push('menu-items')
        @if ($user_role != 1)
            <x-teacher_menu_items dashboard="" class="" attendance="" subject="" student="active" />
        @else
            <x-admin_menu_items dashboard="" attendance="active" subject="" course="" />
        @endif
    @endpush

    @push('search')
        <x-search action="{{ route('teacher.student') }}" query="{{ $query }}" />
    @endpush

@endsection

@section('main-body')
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card h-100">
                <h5 class="card-header text-primary">Students</h5>
                <div class="table-responsive text-nowrap h-100">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Roll no</th>
                                <th>Student Name</th>
                                <th>Course</th>
                                <th>Semester</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (empty($students->total() != 0))
                                <tr>
                                    <td colspan="6" class="text-center">No Students Found</td>
                                </tr>
                            @endif
                            @foreach ($students as $data)
                                <tr>
                                    <td>{{ $data['roll_no'] }}</td>
                                    <td>{{ $data['student_name'] }}</td>
                                    <td>{{ $data['course_name'] }}</td>
                                    <td>{{ $data['semester_name'] }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href=""><i
                                                        class="bx bx-edit-alt me-1"></i> Attendance</a>
                                                <a class="dropdown-item"
                                                    href=""><i
                                                        class="bx bxs-file-export"></i> Export Attendance</a>
                                                <a class="dropdown-item" target=" _blank"
                                                    href=""><i
                                                        class="bx bx-qr-scan me-1"></i> Show QR</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center align-items-center mt-5">
                    {{ $students->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection


@section('scripts')
@endsection