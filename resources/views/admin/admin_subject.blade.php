@extends('layouts.content')

@section('nav-components')
    @push('title')
        <title>Admin Dashboard</title>
    @endpush

    @push('menu-items')
        <x-admin_menu_items dashboard="" attendance="" subject="active" course="" teacher="" student="" />
    @endpush

    @push('search')
        <x-search action="" query="" />
    @endpush
@endsection

@section('main-body')
    <div class="row">

        <div class="col-12 col-lg-8 order-2 mb-4">

            <button type="button" class="btn rounded-pill btn-outline-primary" id="add_subject" data-bs-toggle="modal"
                data-bs-target="#subject_modal">
                <span class="tf-icons bx bx-plus"></span>&nbsp;Subject
            </button>

        </div>

    </div>


    <div class="row " id="results">

        @foreach ($subjects as $data)
            <div class="col-md-4 order-1 order-md-1 order-lg-1 mb-4">
                <div class="card">
                    <div class="d-flex align-items-end row">

                        <div class="card-body results d-flex row justify-content-between align-items-end">

                            <div class="col d-flex justify-content-between align-items-center">

                                <h5 class="text-primary card-title">{{ $data['subject_name'] }}</h5>

                                {{-- <div class="">
                                    <a href="{{ route('attendance.subject', $data['subject_id']) }}"
                                        class="btn btn-sm btn-outline-primary">View Attendance<span
                                            class="tf-icons bx bx-chevron-right"></span></a>
                                </div> --}}

                            </div>

                            <p class="mb-4 ms-3">
                                Subject Code : <span class="fw-bold">{{ $data['subject_code'] }}</span> <br>
                                Course : <span
                                    class="fw-bold">{{ $data['course_name'] != null ? $data['course_name'] : 'Not Assigned' }}</span>
                                <br>
                                Semester : <span
                                    class="fw-bold">{{ $data['semester_name'] != null ? $data['semester_name'] : 'Not Assigned' }}</span>
                                <br>
                                Teacher : <span
                                    class="fw-bold">{{ $data['teacher_name'] != null ? $data['teacher_name'] : 'Not Assigned' }}</span>
                            </p>

                            <div class="col d-flex align-items-center">
                                <div>
                                    <div class="">
                                        <a href="{{ route('attendance.subject', $data['subject_id']) }}"
                                            class="btn btn-sm btn-outline-primary">View Attendance<span
                                                class="tf-icons bx bx-chevron-right"></span></a>
                                    </div>
                                </div>

                                <div class="col d-flex justify-content-end">

                                    <button type="button" onclick="edit_subject(this.id)" id="{{ $data['subject_id'] }}"
                                        class="btn btn-icon btn-outline-primary me-2">
                                        <span class="tf-icons bx bx-edit"></span>
                                    </button>

                                    <a href="{{route('subject.delete',$data['subject_id'])}}"
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
    <div class="modal fade" id='subject_modal' tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="exampleModalLabel1">Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('subject.create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="subject_name" class="form-label">subject Name</label>
                            <input type="text" class="form-control" id="subject_name" value="{{ old('subject_name') }}"
                                name="subject_name" required>
                            @error('subject_name')
                                <span class="text-danger">Subject Name Required</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="subject_code" class="form-label">Subject Code</label>
                            <input type="text" class="form-control" id="subject_code" value="{{ old('subject_code') }}"
                                name="subject_code" required>
                            @error('subject_code')
                                <span class="text-danger">Subject Code Required</span>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <label for="teacher_id">Teacher <small>(optional)</small></label>
                            <select class="form-control" name="teacher_id" id="teacher_id">
                                <option value="" selected>None</option>
                                @foreach ($teachers as $data)
                                    <option value="{{ $data['teacher_id'] }}">{{ $data['teacher_name'] }}</option>
                                @endforeach
                            </select>
                        </div> --}}

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


    <div class="modal fade" id='edit_subject' tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-primary modal-title" id="exampleModalLabel1">Edit Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('subject.edit') }}" method="POST">
                        @csrf

                        <input type="hidden" name="subject_id" value="">

                        <div class="mb-3">
                            <label for="course_name">Subject Name</label>
                            <input type="text" class="form-control" name="subject_name" id="course_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="course_code" class="">Subject Code</label>
                            <input type="text" class="form-control" name="subject_code" id="course_code" required>
                        </div>

                        <div class="form-group">
                            <label for="teacher_id"></label>
                            <select class="form-control" name="teacher_id" id="teacher_id">
                                <option id="0" value="" selected>None</option>
                                @foreach ($teachers as $data)
                                    <option value="{{ $data['teacher_id'] }}">{{ $data['teacher_name'] }}</option>
                                @endforeach
                            </select>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function edit_subject(id) {

            subject_id = id;

            $('#edit_subject').modal('show');

            $.ajax({
                url: "{{ route('get.subjects.id') }}",
                type: "POST",
                data: {
                    subject_id: subject_id,
                    _token: '@csrf'
                },
                success: function(response) {
                    console.log(response);
                    $('#edit_subject input[name="subject_id"]').val(response[0].subject_id);
                    $('#edit_subject input[name="subject_name"]').val(response[0].subject_name);
                    $('#edit_subject input[name="subject_code"]').val(response[0].subject_code);
                    // $('#edit_subject select[name="teacher_id"]').val(response.teacher_id);
                    // select option with same value as response.teacher_id
                    if(response[0].teacher_id != null){
                        $('#edit_subject select[name="teacher_id"] option[value="'+ response[0].teacher_id +'"]').attr('selected', true);
                    }else{
                        console.log('null');
                        // unselect all options
                        $('#edit_subject select[name="teacher_id"] option').attr('selected', false);
                        // select option with id 0
                        $('#edit_subject select[name="teacher_id"] option[id="0"]').attr('selected', true);
                    }

                }
            });

        }
    </script>

    {{-- jquery filter search --}}
    <script type="text/javascript">
        window.onload = function() {
            $("#filter").keyup(function() {

                console.log('key up');
                var filter = $(this).val(),
                    count = 0;

                $('#results div').each(function() {

                    console.log('each');

                    if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                        $(this).hide();

                    } else {
                        $(this).show();
                        count++;
                    }
                });
            });
        }
    </script>

    @include('notify')

@endsection
