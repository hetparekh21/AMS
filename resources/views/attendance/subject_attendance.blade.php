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
                        <span class="card-title text-primary h4"> Course : </span><span class="fw-bold">Software
                            development</span>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4 order-1 order-md-1 order-lg-1 mb-4">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="card-body">
                        <span class="card-title text-primary h4"> Semester : </span><span class="fw-bold">Sem 3</span>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4 order-1 order-md-1 order-lg-1 mb-4">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="card-body">
                        <span class="card-title text-primary h4"> Subject : </span><span class="fw-bold">Advanced Java
                            Programming</span>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div id="chart" style="min-height: 215px;"></div>
        {{-- chart --}}
        {{-- <div class="col-12 col-lg-12 order-1 mb-4">
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
        </div> --}}

    </div>
@endsection

@section('right-side-panel')
@endsection

@section('scripts')
    <script>
        var options = {
            series: [{
                name: 'Average Attendance',
                data: [31, 40, 28, 51, 42, 10, 100]
            }],
            chart: {
                height: 350,
                type: 'area'
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                type: 'datetime',
                categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z",
                    "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z",
                    "2018-09-19T06:30:00.000Z"
                ]
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>

@endsection
