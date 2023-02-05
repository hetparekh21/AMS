@extends('layouts.content')

@section('nav-components')
    @push('title')
        <title>Attendance</title>
    @endpush

    @push('menu-items')
        @if ($user_role != 1)
            <x-teacher_menu_items dashboard="" class="" attendance="active" account="" />
        @else
            <x-admin_menu_items dashboard="" attendance="active" />
        @endif
    @endpush

    @push('search')
        <x-search action="{{ route('teacher.attendance') }}" query="{{ $query }}" />
    @endpush

@endsection

@section('main-body')
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card h-100">
                <h5 class="card-header text-primary">Your Classes</h5>
                <div class="table-responsive text-nowrap h-100">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Class Code</th>
                                <th>Subject</th>
                                <th>Semester</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (empty($classes->total() != 0))
                                <tr>
                                    <td colspan="6" class="text-center">No Classes Found</td>
                                </tr>
                            @endif
                            @foreach ($classes as $data)
                                <tr>
                                    <td>{{ $data['class_id'] }}</td>
                                    <td>{{ $data['class_code'] }}</td>
                                    <td>{{ $data['subject_name'] }}</td>
                                    <td>{{ $data['semester_name'] }}</td>
                                    <td>{{ $data['date'] }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('attendance.class', $data['class_id']) }}"><i
                                                        class="bx bx-edit-alt me-1"></i> Attendance</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('attendance.export', $data['class_id']) }}"><i
                                                        class="bx bxs-file-export"></i> Export Attendance</a>
                                                <a class="dropdown-item" target=" _blank"
                                                    href="{{ route('qr', $data['class_code']) }}"><i
                                                        class="bx bx-qr-scan me-1"></i> Show QR</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center align-items-center">
                    {{ $classes->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection


@section('scripts')
@endsection
