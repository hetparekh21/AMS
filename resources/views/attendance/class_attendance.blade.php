@extends('layouts.content')

@section('nav-components')

    @push('title')
        <title>Class Attendance</title>
    @endpush

    @push('menu-items')
        <x-menu_item link="{{route('teacher.dashboard')}}" name="Dashboard" icon="bx-home-circle" active="" />
        <x-menu_item link="{{route('teacher.class')}}" name="Class" icon="bx-book-open" active="" />
        <x-menu_item link="" name="Attendance" icon="bx-edit-alt me-1" active="active" />
        <x-menu_item link="{{route('teacher.account')}}" name="Account Settings" icon="bx-user" active="" />
        <x-menu_item link="{{route('logout')}}" name="Logout" icon="bx-log-out or power-off" active="" />
    @endpush

@endsection

@section('main-body')

    {{-- <div class="row">

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
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true">
                            <i class="tf-icons bx bxs-user-check"></i> Preset
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile" aria-selected="false">
                            <i class="tf-icons bx bxs-user-x"></i> Absent
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-messages" aria-controls="navs-justified-messages" aria-selected="false">
                            <i class="tf-icons bx bx-current-location"></i> Suspicious 
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                        Home
                    </div>
                    <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                        profile
                    </div>
                    <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
                        messages
                    </div>
                </div>
            </div>

        </div>

        {{-- Pie Chart section --}}

        <div class="col-md-4">

            <div class="card mb-3">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('right-side-panel')

<div class="card mb-3">
    <div class="card-header text-primary">Class Details</div>
    <div class="card-body">
      <h5 class="card-title ">Class Code : ABCDE</h5>
      <p class="card-text">subject : Advanced Java Programming - II <br>
        Course : Software Development <br>
        Semester : Sem 3
        </p>
        <span class="text-muted">Date : 12/12/2011</span>
    </div>
  </div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasEndLabel" class="offcanvas-title">Offcanvas End</h5>
    <button
      type="button"
      class="btn-close text-reset"
      data-bs-dismiss="offcanvas"
      aria-label="Close"
    ></button>
  </div>
  <div class="offcanvas-body my-auto mx-0 flex-grow-0">
    <p class="text-center">
      Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print,
      graphic or web designs. The passage is attributed to an unknown typesetter in the 15th
      century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum
      for use in a type specimen book.
    </p>
    <button type="button" class="btn btn-primary mb-2 d-grid w-100">Continue</button>
    <button
      type="button"
      class="btn btn-outline-secondary d-grid w-100"
      data-bs-dismiss="offcanvas"
    >
      Cancel
    </button>
  </div>
</div>

@endsection