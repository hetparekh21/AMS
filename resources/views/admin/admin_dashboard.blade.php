@extends('layouts.content')

@section('nav-components')
    @push('title')
        <title>Admin Dashboard</title>
    @endpush

    @push('menu-items')
        <x-admin_menu_items dashboard="active" attendance="" subject="" course="" teacher="" student="" />
    @endpush
@endsection

@section('main-body')
    <div class="row">


        <div class="col-md-3 order-1 order-md-1 order-lg-1 mb-4">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="card-body">

                        <span class="card-title text-primary h4">Courses : </span><span
                            class="h5">{{ $data['courses'] }}</span>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 order-1 order-md-1 order-lg-1 mb-4">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="card-body">

                        <span class="card-title text-primary h4">Subjects : </span><span
                            class="h5">{{ $data['subjects'] }}</span>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 order-1 order-md-1 order-lg-1 mb-4">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="card-body">

                        <span class="card-title text-primary h4">Classes : </span><span
                            class="h5">{{ $data['classes'] }}</span>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 order-1 order-md-1 order-lg-1 mb-4">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="card-body">

                        <span class="card-title text-primary h4">Teacher : </span><span
                            class="h5">{{ $data['teachers'] }}</span>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 order-1 order-md-1 order-lg-1 mb-4">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="card-body">

                        <span class="card-title text-primary h4">Students : </span><span
                            class="h5">{{ $data['students'] }}</span>

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
@endsection

@section('scripts')
    {{-- <script>
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

            // Income Chart - Area chart
            // --------------------------------------------------------------------
            const incomeChartEl = document.querySelector('#incomeChart'),
                incomeChartConfig = {
                    series: [{
                        data: [50, 34, 30, 22, 42, 26, 35, 29]
                    }],
                    chart: {
                        height: 215,
                        parentHeightOffset: 0,
                        parentWidthOffset: 0,
                        toolbar: {
                            show: false
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
                            dataPointIndex: 7,
                            strokeColor: config.colors.primary,
                            strokeWidth: 2,
                            size: 6,
                            radius: 8
                        }],
                        hover: {
                            size: 7
                        }
                    },
                    colors: [config.colors.primary],
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
                        padding: {
                            top: -20,
                            bottom: -8,
                            left: -10,
                            right: 8
                        }
                    },
                    xaxis: {
                        categories: ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
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
            if (typeof incomeChartEl !== undefined && incomeChartEl !== null) {
                const incomeChart = new ApexCharts(incomeChartEl, incomeChartConfig);
                incomeChart.render();
            }
        })();
    </script> --}}

    <script>
        /**
         * Dashboard Analytics
         */

        'use strict';

        (function() {
            let cardColor, headingColor, axisColor, shadeColor, borderColor, data, length, second, third;

            cardColor = config.colors.white;
            headingColor = config.colors.headingColor;
            axisColor = config.colors.axisColor;
            borderColor = config.colors.borderColor;
            shadeColor = '#696cff';

            second = [{{ $total_class }}]
            data = [{{ $avg }}];

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
                    colors: [config.colors.primary, config.colors.secondary, config.colors.lightpurple],
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
