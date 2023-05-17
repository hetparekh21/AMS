@extends('layouts.content')

@section('nav-components')
    @push('title')
        <title>Admin Dashboard</title>
    @endpush

    @push('menu-items')
        <x-admin_menu_items dashboard="" attendance="" subject="" course="" teacher="active" student="" />
    @endpush
@endsection

@section('main-body')
    <div class="row">

        <div class="col-12 col-lg-8 order-2 mb-4">

            <button type="button" class="btn rounded-pill btn-outline-primary" id="add_subject" data-bs-toggle="modal"
                data-bs-target="#teacher_modal">
                <span class="tf-icons bx bx-plus"></span>&nbsp;Teacher
            </button>

        </div>

    </div>

    <div class="row">

        @foreach ($teachers as $data)
            <div class="col-md-4 order-1 order-md-1 order-lg-1 mb-4">
                <div class="card">
                    <div class="d-flex align-items-end row">

                        <div class="card-body results d-flex row justify-content-between align-items-end">

                            <div class="col d-flex justify-content-between align-items-center">

                                <h5 class="text-primary card-title">{{ $data->teacher_name }}</h5>

                                {{-- <div class="">
                                    <a href="{{ route('attendance.subject', $data['subject_id']) }}"
                                        class="btn btn-sm btn-outline-primary">View Attendance<span
                                            class="tf-icons bx bx-chevron-right"></span></a>
                                </div> --}}

                            </div>

                            <p class="mb-4 ms-3">
                                Email : <span class="fw-bold">{{ $data->email }}</span> <br>
                                Password : <span class="fw-bold">{{ $data->pass_ }}</span>
                                <br>
                                Subjects : <span class="fw-bold">{{ $data->subs }}</span>
                            </p>

                            <div>
                                <div class="">
                                    <button onclick="assign(this.id)" id="{{ $data->teacher_id }}"
                                        class="btn btn-sm btn-outline-primary">Add Subject<span
                                            class="tf-icons bx bx-chevron-right"></span></button>
                                </div>
                            </div>

                            <div class="col d-flex align-items-center">
                                <div>
                                    <div class="">
                                        <button onclick="unassign(this.id)" id="{{ $data->teacher_id }}"
                                            class="btn btn-sm btn-outline-primary {{ $data->subs == 0 ? 'disabled' : '' }}">Remove
                                            subject<span class="tf-icons bx bx-chevron-right"></span></button>
                                    </div>
                                </div>

                                <div class="col d-flex justify-content-end">

                                    <button type="button" id="{{ $data->teacher_id }}" onclick="edit(this.id)"
                                        class="btn btn-icon btn-outline-primary me-2">
                                        <span class="tf-icons bx bx-edit"></span>
                                    </button>

                                    <a href="{{ route('teacher.delete', $data->teacher_id) }}"
                                        class="btn btn-icon btn-outline-danger">
                                        <span class="tf-icons bx bx-trash"></span>
                                    </a>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection

@section('right-side-panel')
    {{-- Add Teacher --}}
    <div class="modal fade" id='teacher_modal' tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="exampleModalLabel1">Teacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('teacher.create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="teacher_name" class="form-label">Teacher Name</label>
                            <input type="text" class="form-control" id="teacher_name" value="{{ old('teacher_name') }}"
                                name="teacher_name" required>
                            @error('teacher_name')
                                <span class="text-danger">Teacher Name Required</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="teacher_email" class="form-label">Teacher Eamil</label>
                            <input type="email" class="form-control" id="teacher_email"
                                value="{{ old('teacher_email') }}" name="teacher_email" required>
                            @error('teacher_email')
                                <span class="text-danger">Teacher Eamil Required</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="subject_id">Subject <small>(optional)</small></label>
                            <select class="form-control" name="subject_id" id="teacher_id">
                                <option value="" selected disabled>None</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->subject_id }}">{{ $subject->subject_name }}
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <small>({{ $subject->teacher_name != '' ? $subject->teacher_name : 'unassigned' }})</small>
                                    </option>
                                @endforeach
                            </select>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Add Teacher</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Teacher --}}
    <div class="modal fade" id='teacher_edit_modal' tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="exampleModalLabel1">Teacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('teacher.edit') }}" method="POST">
                        @csrf

                        <input type="hidden" name="teacher_id" id="teacher_id">

                        <div class="mb-3">
                            <label for="teacher_name" class="form-label">Teacher Name</label>
                            <input type="text" class="form-control" id="teacher_name"
                                value="{{ old('teacher_name') }}" name="teacher_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="teacher_email" class="form-label">Teacher Eamil</label>
                            <input type="email" class="form-control" id="teacher_email"
                                value="{{ old('teacher_email') }}" name="teacher_email" required>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="pass_regen" id="">
                                Regenerate Password <span class="fw-bold"><small class="pass"></small></span>
                            </label>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Update Teacher</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Add subject --}}
    <div class="modal fade" id='assign_subject_modal' tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="exampleModalLabel1">Assign Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('teacher.assign.subject') }}" method="POST">
                        @csrf

                        <input type="hidden" value="" name="teacher_id">

                        <div class="form-group">
                            <label for="subject_id">Subject <small>(optional)</small></label>
                            <select class="form-control" name="subject_id">
                                <option value="" selected disabled>None</option>
                            </select>
                            @error('subject_id')
                                <span class="text-danger">Please choose a subject</span>
                            @enderror
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Add Subject</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Remove Subject --}}
    <div class="modal fade" id='unassign_subject_modal' tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="exampleModalLabel1">Unassign Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('teacher.subject.remove') }}" method="POST">
                        @csrf

                        <input type="hidden" value="" name="teacher_id">

                        <div class="form-group">
                            <label for="subject_id">Subject <small>(optional)</small></label>
                            <select class="form-control" name="subject_id">
                                <option value="" selected disabled>None</option>
                            </select>
                            @error('subject_id')
                                <span class="text-danger">Please choose a subject</span>
                            @enderror
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Unassign Subject</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function unassign(id) {

            $.ajax({
                url: "{{ route('get.available.subjects', 0) }}",
                type: "GET",
                data: {
                    teacher_id: id,
                },
                success: function(response) {
                    // response = response[0];
                    console.log(response);
                    $('#unassign_subject_modal input[name="teacher_id"]').val(id);
                    $('#unassign_subject_modal select[name="subject_id"]').html(
                        '<option value="" selected disabled>None</option>');
                    $.each(response, function(index, value) {
                        $('#unassign_subject_modal select[name="subject_id"]').append('<option value="' +
                            value.subject_id + '">' + value.subject_name + '</option>');
                    });
                    $('#unassign_subject_modal').modal('show');
                }
            });

        }

        function assign(id) {

            $.ajax({
                url: "{{ route('get.available.subjects', 1) }}",
                type: "GET",
                data: {
                    teacher_id: id,
                },
                success: function(response) {
                    // response = response[0];
                    console.log(response);
                    $('#assign_subject_modal input[name="teacher_id"]').val(id);
                    $('#assign_subject_modal select[name="subject_id"]').html(
                        '<option value="" selected disabled>None</option>');
                    $.each(response, function(index, value) {
                        $('#assign_subject_modal select[name="subject_id"]').append('<option value="' +
                            value.subject_id + '">' + value.subject_name + '</option>');
                    });
                    $('#assign_subject_modal').modal('show');
                }
            });

        }

        function edit(id) {

            $.ajax({
                url: "{{ route('get.teacher') }}",
                type: "GET",
                data: {
                    teacher_id: id,
                },
                success: function(response) {
                    response = response[0];
                    console.log(response);
                    $('#teacher_edit_modal input[name="teacher_id"]').val(response.teacher_id);
                    $('#teacher_edit_modal input[name="teacher_name"]').val(response.teacher_name);
                    $('#teacher_edit_modal input[name="teacher_email"]').val(response.email);
                    $('.pass').html("(Current Pass :" + response.pass_ + ")");
                    $('#teacher_edit_modal').modal('show');
                }
            });
        }
    </script>

    @include('notify')
@endsection
