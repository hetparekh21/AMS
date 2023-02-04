@extends('layouts.content')

@section('nav-components')
    @push('title')
        <title>Teacher</title>
    @endpush

    @push('menu-items')
        <x-menu_item link="{{ route('teacher.dashboard') }}" name="Dashboard" icon="bx-home-circle" active="" />
        <x-menu_item link="{{ route('teacher.class') }}" name="Class" icon="bx-book-open" active="active" />
        <x-menu_item link="{{ route('teacher.attendance') }}" name="Attendance" icon="bx-edit-alt me-1" active="" />
        <x-menu_item link="{{ route('teacher.account') }}" name="Account Settings" icon="bx-user" active="" />
        <x-menu_item link="{{ route('logout') }}" name="Logout" icon="bx-log-out or power-off" active="" />
    @endpush
@endsection

@section('main-body')
    @if (session()->has('qr'))
        <script>
            window.open('{{ route('qr', session()->get('qr')) }}', '_blank')
        </script>
    @endif

    <div class="row">

        <div class="col-12 col-lg-8 order-2 mb-4">

            <button type="button" class="btn rounded-pill btn-outline-primary" id="class" onclick="get_course(this.id)"
                data-bs-toggle="modal" data-bs-target="#class_modal">
                <span class="tf-icons bx bx-plus"></span>&nbsp;Class
            </button>
            <x-class_modal title="Class" action="{{ route('teacher.initiate.class') }}" button="Initiate Class"
                modalname="class_modal" name="class" />

            <button type="button" class="btn rounded-pill btn-outline-secondary" id="template"
                onclick="get_course(this.id)" data-bs-toggle="modal" data-bs-target="#template_modal">
                <span class="tf-icons bx bx-plus"></span>&nbsp;Template
            </button>
            <x-class_modal title="Template" action="{{ route('teacher.create.template') }}" button="Create Template"
                modalname="template_modal" name="template" />

        </div>

    </div>

    {{-- Class table --}}

    {{-- try min-vh-100 or h-100 --}}
    <div class="row">

        <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
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
                            @foreach ($classes['data'] as $data)
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
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-lg">
                            @foreach ($classes['links'] as $data)
                                @if ($data['active'] == '1')
                                    <li class="page-item active">
                                        <a class="page-link" href="{{ $data['url'] }}">{!! $data['label'] !!}</a>
                                    </li>
                                    {{-- <a name="" id="" class="btn btn-primary m-1 active"
                                        href="{{ $data['url'] }}" role="button">{!! $data['label'] !!}</a> --}}
                                @else
                                    <li class="page-item prev">
                                        <a class="page-link" href="{{ $data['url'] }}">{!! $data['label'] !!}</a>
                                    </li>
                                    {{-- <a name="" id="" class="btn btn-primary m-1" href="{{ $data['url'] }}"
                                        role="button">{!! $data['label'] !!}</a> --}}
                                @endif
                            @endforeach
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    @endsection

    @section('right-side-panel')
        <div class="col-md-6 col-lg-4 order-2 mb-4">

            <div class="card overflow-hidden mb-4">
                <h5 class="card-header">Templates</h5>
                <div class="card-body" id="vertical-example">

                    @foreach ($templates as $data)
                        <div class="card shadow-none bg-transparent border border-secondary mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $data['subject_name'] }}</h5>
                                <div class="card-text">
                                    <p>Course : {{ $data['course_name'] }}<br>
                                        Semester : {{ $data['semester_name'] }}
                                    </p>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <form action="{{ route('teacher.handel.template', $data['id']) }}" method="POST">
                                            @csrf
                                            <input type="submit" class="btn rounded-pill btn-primary" name="action"
                                                value="Initiate" />
                                            <input type="submit" class="btn rounded-pill btn-outline-danger" name="action"
                                                value="Delete" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        // check if there are errors in the class initiate form and open it
        @if ($errors->has('course_class') || $errors->has('semester_class') || $errors->has('subject_class'))
            var class_button = document.getElementById('class')
            class_button.click()
        @endif

        // check if there are errors in the create template form and open it
        @if ($errors->has('course_template') || $errors->has('semester_template') || $errors->has('subject_template'))
            var template_button = document.getElementById('template')
            template_button.click()
        @endif

        function get_option() {
            var option = document.createElement('option');
            option.value = '';
            option.innerHTML = 'Select';
            option.selected = true;
            option.disabled = 'true';
            return option;
        }

        function reset(id) {
            $('#course_' + id + ' option').remove();
            $("#course_" + id).append(get_option());

            $('#sub_' + id + ' option').remove();
            $("#sub_" + id).append(get_option());
            $('#sub_' + id).prop('disabled', true)

            $('#sem_' + id + 'option').remove();
            $("#sem_" + id).append(get_option());
            $('#sem_' + id).prop('disabled', true)
        }

        function get_course(id) {

            reset(id);

            $.ajax({
                url: "{{ route('get.course') }}",
                method: "get",
                data: {
                    user_id: {{ Auth::user()->id }}
                },
                success: function(data) {
                    console.log(data);
                    // remove all options from the course select element
                    $('#course_' + id + ' option').remove();
                    // make options and add them in the course select element
                    for (var i = 0; i < data.length; i++) {
                        var option = document.createElement('option');
                        option.value = data[i]['course_id'];
                        option.innerHTML = data[i]['course_name'];
                        $("#course_" + id).append(option);
                    }

                    $("#course_" + id).append(get_option());
                }
            });
        }

        function get_semester(id) {
            $('#sub_' + id + ' option').remove();
            $("#sub_" + id).append(get_option());
            $('#sub_' + id).prop('disabled', true)

            $('#sem_' + id + ' option').remove();
            // $("#sem_"+id).append(get_option());
            // $('#sem_'+id).prop('disabled',true);

            var course_id = $('#course_' + id).val();
            console.log(course_id);
            $.ajax({
                url: "{{ route('get.semester') }}",
                method: "get",
                data: {
                    course_id: course_id,
                    user_id: {{ Auth::user()->id }}
                },
                success: function(data) {
                    console.log(data);
                    $('#sem option').remove();
                    // make options and add them in the semester select element
                    if (data.length > 0) {
                        for (var i = 0; i < data.length; i++) {
                            var option = document.createElement('option');
                            option.value = data[i]['semester_id'];
                            option.innerHTML = data[i]['semester_name'];
                            $("#sem_" + id).append(option);
                        }
                        $("#sem_" + id).append(get_option());
                        $('#sem_' + id).prop('disabled', false);
                    }
                }
            });
        }

        function get_subject(id) {
            var semester_id = $('#sem_' + id).val();
            var course_id = $("#course_" + id).val();
            console.log(semester_id);
            $.ajax({
                url: "{{ route('get.subjects') }}",
                method: "get",
                data: {
                    course_id: course_id,
                    semester_id: semester_id,
                    user_id: {{ Auth::user()->id }}
                },
                success: function(data) {
                    console.log(data);
                    $('#sub_' + id + ' option').remove();
                    // make options and add them in the subject select element
                    if (data.length > 0) {
                        for (var i = 0; i < data.length; i++) {
                            var option = document.createElement('option');
                            option.value = data[i]['subject_id'];
                            option.innerHTML = data[i]['subject_name'];
                            $("#sub_" + id).append(option);
                        }
                        $("#sub_" + id).append(get_option());
                        $('#sub_' + id).prop('disabled', false);
                    } else {
                        var option = document.createElement('option');
                        option.value = '';
                        option.innerHTML = 'No Subjects available in this Semester';
                        $("#sub").append(option);
                    }
                }
            });
        }
    </script>
@endsection
