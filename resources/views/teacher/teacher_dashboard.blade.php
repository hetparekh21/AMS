
@push('title')
    <title>Teacher Dashboard</title>
@endpush

@push('menu-items')
    <x-menu_item link="{{route('teacher.dashboard')}}" name="Dashboard" icon="bx-home-circle" active="active" />
    <x-menu_item link="{{route('teacher.class')}}" name="Class" icon="bx-book-open" active="" />
    <x-menu_item link="{{route('teacher.account')}}" name="Account Settings" icon="bx-user" active="" />
    <x-menu_item link="{{route('logout')}}" name="Logout" icon="bx-log-out or power-off" active="" />
 
    
@endpush

@include('header')

<div class="container-xxl flex-grow-1 container-p-y">

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

<div class="row">

</div>

</div>

@include('footer')