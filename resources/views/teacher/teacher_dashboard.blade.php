@extends('layouts.content')

@section('nav-components')

@push('title')
    <title>Teacher Dashboard</title>
@endpush

@push('menu-items')
    <x-menu_item link="{{route('teacher.dashboard')}}" name="Dashboard" icon="bx-home-circle" active="active" />
    <x-menu_item link="{{route('teacher.class')}}" name="Class" icon="bx-book-open" active="" />
    <x-menu_item link="" name="Attendance" icon="bx-edit-alt me-1" active="" />
    <x-menu_item link="{{route('teacher.account')}}" name="Account Settings" icon="bx-user" active="" />
    <x-menu_item link="{{route('logout')}}" name="Logout" icon="bx-log-out or power-off" active="" />
@endpush

@endsection

@section('main-body')

<div class="row">

  {{-- chart --}}
  <div class="col-12 col-lg-8 order-1 mb-4" >
    <div class="card h-100">
      <div class="card-header">
        SRR
      </div>
      <div class="card-body px-0">
        <div class="tab-content p-0">
          <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel" style="position: relative;">
           
            <div id="incomeChart" style="min-height: 215px;"></div>
               
            <div class="d-flex justify-content-center pt-4 gap-2">    
              <div>
                <p class="mb-n1 mt-1">Expenses This Week</p>
                <small class="text-muted">$39 less than last week</small>
              </div>
            </div>

          <div class="resize-triggers"><div class="expand-trigger"><div style="width: 555px; height: 377px;"></div></div><div class="contract-trigger"></div></div></div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-lg-4 col-md-4 order-2">
    
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <img src="../assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
          </div>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
              <a class="dropdown-item" href="javascript:void(0);">View More</a>
              <a class="dropdown-item" href="javascript:void(0);">Delete</a>
            </div>
          </div>
        </div>
        <span class="fw-semibold d-block mb-1">Profit</span>
        <h3 class="card-title mb-2">$12,628</h3>
        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
      </div>
    </div>
    
  </div>
</div>

@endsection

@section('scripts')

<script>
/**
 * Dashboard Analytics
 */

 'use strict';

(function () {
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
    series: [
      {
        data: [50, 34, 30, 22, 42, 26, 35, 29]
      }
    ],
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
      discrete: [
        {
          fillColor: config.colors.white,
          seriesIndex: 0,
          dataPointIndex: 7,
          strokeColor: config.colors.primary,
          strokeWidth: 2,
          size: 6,
          radius: 8
        }
      ],
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
      min: 10,
      max: 50,
      tickAmount: 4
    }
  };
if (typeof incomeChartEl !== undefined && incomeChartEl !== null) {
  const incomeChart = new ApexCharts(incomeChartEl, incomeChartConfig);
  incomeChart.render();
}
})();
</script>
@endsection