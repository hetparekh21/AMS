@extends('layouts.content')

@section('nav-components')
    @push('title')
        <title>Student Dashboard</title>
    @endpush

    @push('menu-items')
        @if ($user_role == 3)
            <x-menu_item link="{{ route('student.dashboard') }}" name="Dashboard" icon="bx-home-circle" active="active" />
            <x-menu_item link="{{ route('logout') }}" name="Logout" icon="bx-log-out or power-off" active="" />
        @elseif ($user_role == 2)
            <x-teacher_menu_items dashboard="" class="" attendance="" subject="" student="active" />
        @else
            <x-admin_menu_items dashboard="" attendance="" subject="" course="" teacher="" student="active" />
        @endif
        @endpush
    @endsection

    @section('main-body')
        <div class="row">

            <div class="col-md-3 order-1 order-md-1 order-lg-1 mb-4">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="card-body">

                            <span class="card-title text-primary h4">Enrollment No. : </span><span
                                class="h5">{{ $data['roll_no'] }}</span>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 order-1 order-md-1 order-lg-1 mb-4">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="card-body">

                            <a><span class="card-title text-primary h4"> Student : </span><span
                                    class="h5">{{ $data['student_name'] }}</span></a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 order-1 order-md-1 order-lg-1 mb-4">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="card-body">

                            <span class="card-title text-primary h4">Course : </span><span
                                class="h5">{{ $data['course_name'] }}</span>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 order-1 order-md-1 order-lg-1 mb-4">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="card-body">

                            <span class="card-title text-primary h4">Semester : </span><span
                                class="h5">{{ $data['semester_name'] }}</span>

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

                                <div id="incomeChart" style="min-height: 215px;"></div>

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
            {{-- chart end --}}
        </div>

        <div class="row">

            @foreach ($subjects as $data)
                <div class="col-md-4 order-1 order-md-1 order-lg-1 mb-4">
                    <div class="card">
                        <div class="row">

                            <div class="card-body">
                                <h5 class="card-title text-primary">{{ $data['subject_name'] }}</h5>
                                <p class="mb-4">
                                    Subject Code : <span class="fw-bold">{{ $data['subject_code'] }}</span> <br>
                                    classes : <span class="fw-bold">{{ $data['classes'] }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
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

                // {{-- second = [{{ $total_stu_str }}] --}}

                data = [{{ $avg }}];
                second = [{{ $total_classes }}];
                length = data.length - 1;

                const piechart = document.querySelector('#incomeChart'),
                    piechartConfig = {
                        series: [{
                            name: "Classes Conducted",
                            data: second
                        }, {
                            name: "Average Attended",
                            data: data
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
