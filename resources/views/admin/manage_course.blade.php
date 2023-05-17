@extends('layouts.content')

@section('nav-components')
    @push('title')
        <title>Admin Dashboard</title>
    @endpush

    @push('menu-items')
        <x-admin_menu_items dashboard="" attendance="" subject="" course="active" teacher="" student="" />
    @endpush
@endsection

@section('main-body')
    <div class="row">

        <div class="col-md-4 order-1 order-md-1 order-lg-1 mb-4">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="card-body">

                        <span class="card-title text-primary h4">Course Name : </span><span
                            class="h5">{{ $course['course_name'] }}</span>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 order-1 order-md-1 order-lg-1 mb-4">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="card-body">

                        <span class="card-title text-primary h4">Course Code : </span><span
                            class="h5">{{ $course['course_code'] }}</span>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 order-1 order-md-1 order-lg-1 mb-4">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="card-body">

                        <span class="card-title text-primary h4">Semesters : </span><span
                            class="h5">{{ $course['semesters'] }}</span>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <?php $j = 0;
        $count = count($subjects);
        $empty = 0;
        ?>

        @for ($i = 1; $i <= $semesters; $i++)
            <div class="col-6 mb-4 ">

                <div class="card">

                    @if (($j < $count && $subjects[$j]['semester_id'] != $i) || $j >= $count)
                        <span class="flex-shrink-0 badge badge-center rounded-pill bg-warning w-px-20 h-px-20">!</span>
                        @php
                            $empty = 1;
                        @endphp
                    @endif
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="text-primary">Semester {{ $i }} </h4>
                        <div>
                            <button type="button" id="{{ $course['course_id'] . '_' . $i }}"
                                class="btn btn-icon btn-outline-primary" onclick="addSubject(this.id)">
                                <span class="display-6 tf-icons bx bx-plus"></span>
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Subject Name</th>
                                    <th>Subject Code</th>
                                    <th>Actions</th>
                                    {{-- <th></th> --}}
                                </tr>
                            </thead>
                            <tbody>

                                @while ($j < $count && $subjects[$j]['semester_id'] == $i)
                                    <tr>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>{{ $subjects[$j]['subject_name'] }}</strong>
                                        </td>
                                        <td>{{ $subjects[$j]['subject_code'] }}</td>
                                        <td>
                                            <form
                                                action="{{ route('course.subject.remove', [$course['course_id'], $subjects[$j]['subject_id']]) }}"
                                                method="post">
                                                @csrf
                                                <button class="btn btn-icon btn-outline-danger"><span
                                                        class="display-6 tf-icons bx bx-trash"></span></button>
                                            </form>
                                        </td>
                                    </tr>

                                    @php
                                        $j++;
                                    @endphp
                                @endwhile

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endfor

        <div class="row mt-3">
            <div class="card">
                <div class="d-flex align-items-center row">
                    <div class="card-body">

                        <button type="submit" class="btn" data-bs-toggle="modal" data-bs-target="#edit_course">
                            <h4 class="text-danger">Edit course</h4>
                        </button>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="card">
                <div class="d-flex align-items-center row">
                    <div class="card-body">

                        <form action="{{ route('course.delete', $course['course_id']) }}" method="post">
                            @csrf
                            <button type="submit" class="btn">
                                <h4 class="text-danger">Delete this course ?</h4>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('right-side-panel')
    <div class="modal fade" id='add_subject' tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-primary modal-title" id="exampleModalLabel1">Add Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('course.subject.add') }}" method="POST">
                        @csrf

                        <input type="hidden" id="composite" name="composite" value="">

                        {{-- Teacher Dropdown --}}
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameBasic" class="form-label">Subjects</label>
                                <select class="form-control" name="subject_id" required>
                                    <option selected>None</option>
                                </select>
                            </div>
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

    <div class="modal fade" id='edit_course' tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-primary modal-title" id="exampleModalLabel1">Edit Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('course.edit', $course['course_id']) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                          <label for="course_name">Course Name</label>
                          <input type="text" class="form-control" name="course_name" id="course_name" value="{{ $course['course_name'] }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="course_code" class="">Course Code</label>
                            <input type="text" class="form-control" name="course_code" id="course_code" value="{{ $course['course_code'] }}" required>
                          </div>


                        <div class="mb-3">
                            <label for="course_description" class="form-label">Semesters</label>
                            <input type="number" class="form-control" id="semesters" min="1" max="10"
                                value="{{$course['semesters']}}" name="semesters" required>
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
        function addSubject(id) {

            $.ajax({
                url: "{{ route('get.subjects.plain') }}",
                type: "GET",
                success: function(data) {

                    console.log(data);

                    var subjects = data;
                    var options = '';
                    for (var i = 0; i < data.length; i++) {
                        options += '<option value="' + subjects[i]['subject_id'] + '">' + subjects[i][
                            'subject_name'
                        ] + '</option>';
                    }

                    $('#add_subject').find('select').html(options);
                    $('#add_subject').modal('show');

                    document.getElementById('composite').value = id;

                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
    </script>

    @if ($empty)
        <div class="bs-toast toast toast-placement-ex m-2 fade bg-warning top-0 end-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">Warning</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">You may have few subjects left to add</div>
        </div>

        <script>
            $(function() {
                $('.toast').toast('show');
            });
        </script>
    @endif

    @include('notify')
@endsection
