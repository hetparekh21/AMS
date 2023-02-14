@extends('layouts.content')

@section('nav-components')
    @push('title')
        <title>Subject Attendance</title>
    @endpush

    @push('menu-items')
        @if ($user_role != 1)
            <x-teacher_menu_items dashboard="" class="" attendance="" subject="active" />
        @else
            <x-admin_menu_items dashboard="" attendance="" subject="active" />
        @endif
    @endpush
@endsection

@section('main-body')
    <div class="row">


        <div class="col-md-4 order-1 order-md-1 order-lg-1 mb-4">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="card-body">

                        <span class="card-title text-primary h4"> Subject : </span><span
                            class="fw-bold">{{ $subject_details[0]['subject_name'] }}</span>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 order-1 order-md-1 order-lg-1 mb-4">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="card-body">

                        <span class="card-title text-primary h4"> Semester : </span><span
                            class="fw-bold">{{ $subject_details[0]['semester_name'] }}</span>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 order-1 order-md-1 order-lg-1 mb-4">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="card-body">

                        <a><span class="card-title text-primary h4"> Teacher : </span><span
                                class="fw-bold">{{ $subject_details[0]['teacher_name'] }}</span></a>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        {{-- chart --}}
        <div class="col-12 col-lg-12 order-1 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    Average Attendance
                </div>
                <div class="card-body px-0">
                    <div class="tab-content p-0">
                        <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel"
                            style="position: relative;">

                            {{-- <div id="incomeChart" style="min-height: 215px;"></div> --}}
                            <div id="chart" style="min-height: 215px;"></div>

                            <div class="resize-triggers">
                                <div class="expand-trigger">
                                    <div style="width: 555px; height: 377px;"></div>
                                </div>
                                <div class="contract-trigger"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card h-100">
                <h5 class="card-header text-primary">10 Recent Classes</h5>
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
            </div>
        </div>

    </div>
@endsection

@section('right-side-panel')
@endsection

@section('scripts')
    <script>
        /**
         * Dashboard Analytics
         */

        'use strict';

        (function() {
            let cardColor, headingColor, axisColor, shadeColor, borderColor, data, length, second;

            cardColor = config.colors.white;
            headingColor = config.colors.headingColor;
            axisColor = config.colors.axisColor;
            borderColor = config.colors.borderColor;
            shadeColor = '#696cff';

            second = [{{ $total_stu_str }}]

            data = [{{ $avg }}];
            length = data.length - 1;

            const piechart = document.querySelector('#chart'),
                piechartConfig = {
                    series: [{
                        name: "Average",
                        data: data
                    }, {
                        name: "Total Students",
                        data: second
                    }],
                    chart: {
                        height: 215,
                        parentHeightOffset: 0,
                        parentWidthOffset: 0,
                        toolbar: {
                            show: true,
                            tools: {
                                pan: false
                            }
                        },
                        type: 'area'
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2,
                        curve: 'smooth'
                    },
                    legend: {
                        show: false
                    },
                    markers: {
                        size: 6,
                        colors: 'transparent',
                        strokeColors: 'transparent',
                        strokeWidth: 4,
                        discrete: [{
                            fillColor: config.colors.white,
                            seriesIndex: 0,
                            // little dot on the end
                            dataPointIndex: length,
                            strokeColor: config.colors.primary,
                            strokeWidth: 2,
                            size: 6,
                            radius: 8
                        }],
                        hover: {
                            size: 7
                        }
                    },
                    colors: [config.colors.primary, config.colors.secondary],
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: shadeColor,
                            shadeIntensity: 0.6,
                            opacityFrom: 0.5,
                            opacityTo: 0.25,
                            stops: [0, 95, 100]
                        }
                    },
                    grid: {
                        borderColor: borderColor,
                        strokeDashArray: 3,
                        // padding: {
                        //     top: -20,
                        //     bottom: -8,
                        //     left: -10,
                        //     right: 8
                        // }
                    },
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                            'Dec'
                        ],
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            show: true,
                            style: {
                                fontSize: '13px',
                                colors: axisColor
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            show: false
                        },
                        tickAmount: 4
                    }
                };
            if (typeof piechart !== undefined && piechart !== null) {
                const pieChart_ = new ApexCharts(piechart, piechartConfig);
                pieChart_.render();
            }
        })();
    </script>
@endsection
