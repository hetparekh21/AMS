@extends('layouts.content')

@section('nav-components')
    @push('title')
        <title>Class Attendance</title>
    @endpush

    @push('menu-items')
        @if ($user_role != 1)
            <x-menu_item link="{{ route('teacher.dashboard') }}" name="Dashboard" icon="bx-home-circle" active="" />
            <x-menu_item link="{{ route('teacher.class') }}" name="Class" icon="bx-book-open" active="" />
            <x-menu_item link="{{ route('teacher.attendance') }}" name="Attendance" icon="bx-edit-alt me-1" active="active" />
            <x-menu_item link="{{ route('teacher.account') }}" name="Account Settings" icon="bx-user" active="" />
            <x-menu_item link="{{ route('logout') }}" name="Logout" icon="bx-log-out or power-off" active="" />
        @else
            <x-menu_item link="{{ route('admin.dashboard') }}" name="Dashboard" icon="bx-home-circle" active="" />
            <x-menu_item link="{{ route('teacher.attendance') }}" name="Attendance" icon="bx-edit-alt me-1" active="active" />
            <x-menu_item link="{{ route('logout') }}" name="Logout" icon="bx-log-out or power-off" active="" />
        @endif
    @endpush
@endsection

@section('main-body')
    {{-- <div class="row">

      <pre>
        @php
          print_r($class);
        @endphp
      </pre>

        <div class="col-12 col-lg-8 order-2 mb-4" >

            <button class="btn rounded-pill btn-outline-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd">
              <span class="tf-icons bx bx-detail" ></span>Details
            </button>

        </div>
    </div> --}}

    <div class="row">

        {{-- attendance section --}}

        <div class="col-md-8 order-1 order-md-1 order-lg-1 mb-4">

            <div class="nav-align-top mb-4 h-100">
                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" id="present_tab" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true">
                            <i class="tf-icons bx bxs-user-check"></i> Present
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" id="absent_tab" data-bs-toggle="tab"
                            data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile"
                            aria-selected="false">
                            <i class="tf-icons bx bxs-user-x"></i> Absent
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" id="suspicious_tab" data-bs-toggle="tab"
                            data-bs-target="#navs-justified-messages" aria-controls="navs-justified-messages"
                            aria-selected="false">
                            <i class="tf-icons bx bx-current-location"></i> Suspicious
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                        @error('id_present')
                            <span class="text-danger">No Students Selected</span>
                        @enderror
                        <div class="table-responsive text-nowrap h-100">
                            <table class="table">
                                <form method="POST" action="{{ route('attendance.absent') }}">
                                    <input type="hidden" name="class_id" value="{{ $class_id }}">
                                    @csrf
                                    <div class="mx-4 my-2">

                                        <input type="checkbox" class="form-check-input form-check-inline "
                                            name="check_all_present" id="check_all_present">
                                        <label class="form-check-label" for="check_all_present"> Check All </label>

                                        <button class="btn rounded-pill btn-primary ms-5" id="mark_absent"
                                            type="submit"><span><i class="tf-icons bx bxs-user-x"></i></span> Mark
                                            Absent</button>

                                    </div>

                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Roll no.</th>
                                            <th>Student Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendance as $data)
                                            @if ($data['attendance'] == 1)
                                                <tr>
                                                    <td><input class="form-check-input check_box_present" type="checkbox"
                                                            name="id_present[]" value="{{ $data['id'] }}"></td>
                                                    <td>{{ $data['id'] }}</td>
                                                    <td>{{ $data['name'] }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </form>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                        @error('id_absent')
                            <span class="text-danger">No Students Selected</span>
                        @enderror
                        <div class="table-responsive text-nowrap h-100">
                            <table class="table">
                                <form method="POST" action="{{ route('attendance.present') }}">
                                    <input type="hidden" name="class_id" value="{{ $class_id }}">
                                    @csrf
                                    <div class="mx-4 my-2">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input form-check-inline"
                                                name="check_all_absent" id="check_all_absent">
                                            <label class="form-check-label" for="check_all_absent"> Check All </label>

                                            <button class="btn rounded-pill btn-primary ms-5" id="mark_present"
                                                type="submit"><span><i class="tf-icons bx bxs-user-x"></i></span> Mark
                                                Present</button>
                                        </div>

                                    </div>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Roll no.</th>
                                            <th>Student Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendance as $data)
                                            @if ($data['attendance'] == 0)
                                                <tr>
                                                    <td><input class="form-check-input check_box_absent" type="checkbox"
                                                            name="id_absent[]" value="{{ $data['id'] }}"></td>
                                                    <td>{{ $data['id'] }}</td>
                                                    <td>{{ $data['name'] }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </form>
                            </table>
                        </div>
                    </div>


                    <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
                        @error('id_suspicious')
                            <span class="text-danger">No Students Selected</span>
                        @enderror
                        <div class="table-responsive text-nowrap h-100">
                            <table class="table">
                                <form method="POST" action="{{ route('attendance.from_suspicious') }}">
                                    <input type="hidden" name="class_id" value="{{ $class_id }}">
                                    @csrf
                                    <div class="mx-4 my-2">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="check_all_suspicious"
                                                id="check_all_suspicious">
                                            <label class="form-check-label" for="check_all_suspicious"> Check All </label>

                                            <button class="btn rounded-pill btn-primary ms-5" name="present"
                                                value="present" type="submit"><span><i
                                                        class="tf-icons bx bxs-user-check"></i></span> Mark
                                                Present</button>

                                            <button class="btn rounded-pill btn-primary ms-5" name="absent"
                                                value="absent" type="submit"><span><i
                                                        class="tf-icons bx bxs-user-x"></i></span> Mark
                                                Absent</button>
                                        </div>

                                    </div>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Roll no.</th>
                                            <th>Student Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendance as $data)
                                            @if ($data['attendance'] == 2)
                                                <tr>
                                                    <td><input class="form-check-input check_box_suspicious"
                                                            type="checkbox" name="id_suspicious[]"
                                                            value="{{ $data['id'] }}">
                                                    </td>
                                                    <td>{{ $data['id'] }}</td>
                                                    <td>{{ $data['name'] }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </form>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Pie Chart section --}}

        <div class="col-md-4">

            <div class="card text-end mb-4">
                <div class="card-body" id="piechart"></div>
            </div>

            <div class="card mb-3">
                <div class="card-header text-primary d-flex">
                    <div class="p-2"> Class Details </div>
                    <div class="ml-auto p-2">
                        <a href="{{route('attendance.export',$class_id)}}" class="card-link">Export Attendance <span><i
                                    class="bx bxs-file-export"></i></span></a>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title ">Class Code : {{ $class[0]['class_code'] }}</h5>
                    <p class="card-text">subject : {{ $class[0]['subject_name'] }} <br>
                        Course : {{ $class[0]['course_name'] }} <br>
                        Semester : {{ $class[0]['semester_name'] }}
                    </p>
                    <span class="text-muted">Date : {{ $class[0]['date'] }}</span>
                </div>
            </div>

        </div>

    </div>
@endsection

@section('right-side-panel')
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasEndLabel" class="offcanvas-title">Offcanvas End</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body my-auto mx-0 flex-grow-0">
            <p class="text-center">
                Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print,
                graphic or web designs. The passage is attributed to an unknown typesetter in the 15th
                century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum
                for use in a type specimen book.
            </p>
            <button type="button" class="btn btn-primary mb-2 d-grid w-100">Continue</button>
            <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">
                Cancel
            </button>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        /**
         * Dashboard Analytics
         */

        'use strict';

        (function() {
            let cardColor, headingColor, axisColor, shadeColor, borderColor;

            cardColor = config.colors.white;
            headingColor = config.colors.headingColor;
            axisColor = config.colors.axisColor;
            borderColor = config.colors.borderColor;
            shadeColor = '#696cff';


            var options = {
                colors: ['#00e396', '#fc586e', '#8592a3'],
                series: [{{ $present }}, {{ $absent }}, {{ $suspicious }}],
                chart: {
                    width: 380,
                    type: 'pie',
                },
                labels: ['Present', 'Absent', 'Suspicious'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#piechart"), options);
            chart.render();

        })();
    </script>

    @error('id_absent')
        <script>
            // click button with absent_tab id with jquery
            $(document).ready(function() {
                $('#absent_tab').click();
            });
        </script>
    @enderror

    @error('id_suspicious')
        <script>
            // click button with absent_tab id with jquery
            $(document).ready(function() {
                $('#suspicious_tab').click();
            });
        </script>
    @enderror

    <script>
        // check all checkboxex on click of the check all checkbox
        $("#check_all_present").click(function() {
            $('.check_box_present').not(this).prop('checked', this.checked);
        });

        // uncheck the check all checkbox if any of the checkboxes are unchecked
        $('.check_box_present').change(function() {
            if (false == $(this).prop("checked")) { //if this item is unchecked
                $("#check_all_present").prop('checked', false); //change "select all" checked status to false
            }
            //check "select all" if all checkbox items are checked
            if ($('.check_box_present:checked').length == $('.check_box_present').length) {
                $("#check_all_present").prop('checked', true);
            }
        });


        // check all checkboxex on click of the check all checkbox
        $("#check_all_absent").click(function() {
            $('.check_box_absent').not(this).prop('checked', this.checked);
        });

        // uncheck the check all checkbox if any of the checkboxes are unchecked
        $('.check_box_absent').change(function() {
            if (false == $(this).prop("checked")) { //if this item is unchecked
                $("#check_all_absent").prop('checked', false); //change "select all" checked status to false
            }
            //check "select all" if all checkbox items are checked
            if ($('.check_box_absent:checked').length == $('.check_box_absent').length) {
                $("#check_all_absent").prop('checked', true);
            }
        });
    </script>
@endsection
