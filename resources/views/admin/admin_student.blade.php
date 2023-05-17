@extends('layouts.content')

@section('nav-components')
    @push('title')
        <title>Admin Dashboard</title>
    @endpush

    @push('menu-items')
        <x-admin_menu_items dashboard="" attendance="" subject="" course="" teacher="" student="active" />
    @endpush

    @push('search')
        <x-search action="{{ route('admin.student') }}" query="{{ $query }}" />
    @endpush
@endsection

@section('main-body')
    <div class="row">

        <div class="col-12 col-lg-8 order-2 mb-4">

            <button type="button" class="btn rounded-pill btn-outline-primary" id="add_subject" data-bs-toggle="modal"
                data-bs-target="#student_modal">
                <span class="tf-icons bx bx-plus"></span>&nbsp;Student
            </button>

        </div>

    </div>

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
                                <th>Email</th>
                                <th>Password</th>
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
                                    <td>{{ $data['email'] }}</td>
                                    <td>{{ $data['pass_'] }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" onclick="edit(this.id)"
                                                    id="{{ $data['student_id'] }}"><i class="bx bx-edit-alt me-1"></i>
                                                    Edit</a>
                                                <a class="dropdown-item" href="{{route('student.dashboard',$data['uid'])}}"><i class="bx bx-edit-alt me-1"></i>
                                                    Attendance</a>
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

@section('right-side-panel')
    {{-- Add Student --}}
    <div class="modal fade" id='student_modal' tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="exampleModalLabel1">Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('student.create') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="roll_no" class="form-label">Enrollment Number<small class="text-danger"> (Once
                                    assigned cannot be
                                    edited)</small></label>
                            <input type="number" class="form-control" id="roll_no" value="{{ old('roll_no') }}"
                                name="roll_no" required>
                            @error('roll_no')
                                <span class="text-danger">Enrollment Number Required</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="student_name" class="form-label">Student Name</label>
                            <input type="text" class="form-control" id="student_name" value="{{ old('student_name') }}"
                                name="student_name" required>
                            @error('student_name')
                                <span class="text-danger">Student Name Required</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Student Eamil</label>
                            <input type="email" class="form-control" id="email"
                                value="{{ old('email') }}" name="email" required>
                            @error('email')
                                <span class="text-danger">Student Eamil Required</span>
                            @enderror
                        </div>


                        <div class="form-group mb-3">
                            <label for="course_id">Course<small class="text-danger"> (Once assigned cannot be
                                    edited)</small></label>
                            <select class="form-control" name="course_id" id="course_id" onchange="get_semesters()"
                                required>
                                <option value="" selected disabled>None</option>
                                @foreach ($courses as $data)
                                    <option value="{{ $data['course_id'] }}">{{ $data['course_name'] }}</option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <span class="text-danger">Course Is Required</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="semester_id">Semester</label>
                            <select class="form-control" name="semester_id" id="semester_id" disabled required>
                                <option value="" selected disabled>None</option>
                            </select>
                            @error('semester_id')
                                <span class="text-danger">Semester Is Required</span>
                            @enderror
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Add Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Student --}}
    <div class="modal fade" id='student_edit_modal' tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="exampleModalLabel1">Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('student.edit') }}" method="POST">
                        @csrf

                        <input type="hidden" name="student_id">

                        <div class="mb-3">
                            <label for="roll_no" class="form-label">Enrollment Number</label>
                            <input type="number" class="form-control" id="roll_no" value="{{ old('roll_no') }}"
                                name="roll_no" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="student_name" class="form-label">Student Name</label>
                            <input type="text" class="form-control" id="student_name"
                                value="{{ old('student_name') }}" name="student_name" required>
                            @error('student_name')
                                <span class="text-danger">Student Name Required</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Student Email</label>
                            <input type="email" class="form-control" id="email"
                                value="{{ old('email') }}" name="email" required>
                            @error('email')
                                <span class="text-danger">Student Eamil Required</span>
                            @enderror
                        </div>

                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="pass_regen" id="">
                                Regenerate Password <span class="fw-bold"><small class="pass"></small></span>
                            </label>
                        </div>

                        <div class="mb-3">
                            <label for="course_name" class="form-label">Course</label>
                            <input type="text" class="form-control" id="course_name"
                                value="{{ old('course_name') }}" name="course_name" disabled>
                            @error('course_name')
                                <span class="text-danger">Course Required</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="semester_id">Semester</label>
                            <select class="form-control" name="semester_id" id="semester_id" required>
                                <option value="" selected disabled>None</option>
                            </select>
                            @error('semester_id')
                                <span class="text-danger">Semester Is Required</span>
                            @enderror
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Update Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function get_semesters() {

            // get the selected option value
            var course_id = $('#student_modal select[name="course_id"]').val();
            console.log(course_id);

            // get the semesters related to this course
            $.ajax({
                url: "{{ route('get.semester', 1) }}",
                type: "GET",
                data: {
                    course_id: course_id,
                },
                success: function(response) {
                    // response = response[0];
                    console.log(response);
                    $('#student_modal select[name="semester_id"]').html(
                        '<option value="" selected disabled>None</option>');
                    $.each(response, function(index, value) {
                        $('#student_modal select[name="semester_id"]').append(
                            '<option value="' +
                            value.semester_id + '">' + value.semester_name + '</option>');
                    });
                    $('#student_modal select[name="semester_id"]').prop('disabled', false);
                }
            });

        }

        function edit(id) {

            var student_id = id;

            $.ajax({
                url: "{{ route('get.student.id') }}",
                method: "GET",
                data: {
                    student_id: student_id,
                },
                success: function(response) {
                    response = response[0];
                    console.log(response);
                    $('#student_edit_modal input[name="roll_no"]').val(response.roll_no);
                    $('#student_edit_modal input[name="student_id"]').val(response.student_id);
                    $('#student_edit_modal input[name="student_name"]').val(response.student_name);
                    $('#student_edit_modal input[name="email"]').val(response.email);
                    $('#student_edit_modal input[name="course_name"]').val(response.course_name);
                    $('.pass').html("(Current Pass :" + response.pass_ + ")");
                    $('#student_edit_modal select[name="semester_id"]').html('');
                    // get semesters
                    $.ajax({
                        url: "{{ route('get.semester',1) }}",
                        type: "GET",
                        data: {
                            course_id: response.course_id,
                        },
                        success: function(data) {
                            // response = response[0];
                            console.log(data);
                            
                            $.each(data, function(index, value) {
                                $('#student_edit_modal select[name="semester_id"]').append(
                                    '<option value="' +
                                    value.semester_id + '">' + value.semester_name +
                                    '</option>');
                            });
                            $('#student_edit_modal select[name="semester_id"]').prop('disabled', false);
                            $('#student_edit_modal select[name="semester_id"] option[value="' + response.semester_id +'"]').attr('selected', true);
                        }
                    });

                    $('#student_edit_modal').modal('show');
                }
            });

        }
    </script>

    @include('notify')
@endsection
