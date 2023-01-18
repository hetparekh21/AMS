@push('title')
  <title>Teacher</title>
@endpush

@push('menu-items')
  <x-menu_item link="{{route('teacher.dashboard')}}" name="Dashboard" icon="bx-home-circle" active="" />
  <x-menu_item link="{{route('teacher.class')}}" name="Class" icon="bx-book-open" active="active" />
  <x-menu_item link="{{route('teacher.account')}}" name="Account Settings" icon="bx-user" active="" />
  <x-menu_item link="{{route('logout')}}" name="Logout" icon="bx-log-out or power-off" active="" />
@endpush

@include('header')

<?php 
echo "<script>window.open('www.google.com', '_blank')</script>"
?>



<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">

      <div class="col-12 col-lg-8 order-2 mb-4" >

        <button type="button" class="btn rounded-pill btn-outline-primary" id="class" onclick="get_course()" data-bs-toggle="modal" data-bs-target="#class_modal">
          <span class="tf-icons bx bx-plus" ></span>&nbsp;Class
        </button>
        
        <button type="button" class="btn rounded-pill btn-outline-secondary" id="template" onclick="get_course()" data-bs-toggle="modal" data-bs-target="#template_modal">
          <span class="tf-icons bx bx-plus"></span>&nbsp;Template
        </button>

        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
          Launch modal
        </button> --}}

      </div>

    </div>

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
                    <th><a href="https://www.google.com" target="_blank"></a></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($classes as $data)
                    <tr>
                      <td>{{$data['class_id']}}</td>
                      <td>{{$data['class_code']}}</td>
                      <td>{{$data['subject_name']}}</td>
                      <td>{{$data['semester_name']}}</td>
                      <td>{{$data['date']}}</td>
                      <td><div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu" >
                            <a class="dropdown-item" href="{{route('attendance',1)}}"
                              ><i class="bx bx-detail me-1"></i> Details</a
                            >
                            <a class="dropdown-item" href="{{route('attendance',1)}}"
                              ><i class="bx bx-edit-alt me-1"></i> Attendance</a
                            >
                            <a class="dropdown-item" href="javascript:void(0);"
                              ><i class="bx bxs-file-export"></i> Export Attendance</a
                            >
                            <a class="dropdown-item" target=" _blank" href="{{ route('qr', $data['class_code']) }}"
                              ><i class="bx bx-qr-scan me-1"></i> Show QR</a
                            >
                          </div>
                        </div></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        
        <div class="col-md-6 col-lg-4 order-2 mb-4">

            <div class="card overflow-hidden mb-4" style="height: 500px">
              <h5 class="card-header">Templates</h5>
              <div class="card-body" id="vertical-example">
                
                <div class="card shadow-none bg-transparent border border-secondary mb-3">
                  <div class="card-body">
                    <h5 class="card-title">Advanced Java Programming</h5>
                    <div class="card-text">
                      <p>Course : Software Development<br>
                        Semester : Sem 3
                      </p>
                    </div>
                    <div class="row" >
                      <div class="col" >
                        <button type="button" class="btn rounded-pill btn-primary">Initiate</button>
                        <button type="button" class="btn rounded-pill btn-outline-danger">Delete</button>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card shadow-none bg-transparent border border-secondary mb-3">
                  <div class="card-body">
                    <h5 class="card-title">Database Administration</h5>
                    <div class="card-text">
                      <p>Course : Software Development<br>
                        Semester : Sem 3
                      </p>
                    </div>
                    <div class="row" >
                      <div class="col" >
                        <button type="button" class="btn rounded-pill btn-primary">Initiate</button>
                        <button type="button" class="btn rounded-pill btn-outline-danger">Delete</button>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card shadow-none bg-transparent border border-secondary mb-3">
                  <div class="card-body">
                    <h5 class="card-title">Programming Using Python - II</h5>
                    <div class="card-text">
                      <p>Course : Software Development<br>
                        Semester : Sem 4
                      </p>
                    </div>
                    <div class="row" >
                      <div class="col" >
                        <button type="button" class="btn rounded-pill btn-primary">Initiate</button>
                        <button type="button" class="btn rounded-pill btn-outline-danger">Delete</button>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>

        </div>
    
    </div>

</div>

@include('footer')

<x-class_modal title="Class" action="{{route('teacher.initiate.class')}}" button="Initiate Class" modalname="class_modal" name="class"/>
<x-class_modal title="Template" action="" button="Create Template" modalname="template_modal" name="template"/>
{{-- <script>

  // @isset($qr)
  
  // @endisset
  

</script> --}}
<script>
  
  // check if there are errors in the class initiate form and open it
  @if($errors->has('course_class') || $errors->has('semester_class') || $errors->has('subject_class'))
    var class_button = document.getElementById('class')
    class_button.click()
  @endif
  
  // check if there are errors in the create template form and open it
  @if($errors->has('course_template') || $errors->has('semester_template') || $errors->has('subject_template'))
    var template_button = document.getElementById('template')
    template_button.click()
  @endif

  function get_option(){
      var option = document.createElement('option');
      option.value = '';
      option.innerHTML = 'Select';
      option.selected = true;
      option.disabled = 'true' ;
      return option;
    }

  function reset(){
      $('#course option').remove();
      $("#course").append(get_option());
    
      $('#sub option').remove();
      $("#sub").append(get_option());
      $('#sub').prop('disabled',true)
    
      $('#sem option').remove();
      $("#sem").append(get_option());
      $('#sem').prop('disabled',true)
    }

  function get_course() {
    
    reset();
  
    $.ajax({
      url: "{{route('get.course')}}",
      method: "post",
      data: {user_id:{{Auth::user()->id}}},
      success: function(data) {
        console.log(data);
        // remove all options from the course select element
        $('#course option').remove();
        // make options and add them in the course select element
        for (var i = 0; i < data.length; i++) {
          var option = document.createElement('option');
          option.value = data[i]['course_id'];
          option.innerHTML = data[i]['course_name'];
          $("#course").append(option);
        }
        
        $("#course").append(get_option());
      }
    });
  }

  // $('#class').click();
  // $('#template').click(get_course());

  $(document).ready(function() {

    // use ajax to fill the semester select
    $('#course').change(function() {
    
      $('#sub option').remove();
      $("#sub").append(get_option());
      $('#sub').prop('disabled',true)
    
      $('#sem option').remove();
      $("#sem").append(get_option());
      $('#sem').prop('disabled',true);
    
      var course_id = $(this).val();
      console.log(course_id);
      $.ajax({
        url: "{{route('get.semester')}}",
        method: "post",
        data: {course_id: course_id,user_id:{{Auth::user()->id}}},
        success: function(data) {
          console.log(data);
          $('#sem option').remove();
          // make options and add them in the semester select element
          if(data.length > 0){
            for (var i = 0; i < data.length; i++) {
              var option = document.createElement('option');
              option.value = data[i]['semester_id'];
              option.innerHTML = data[i]['semester_name'];
              $("#sem").append(option);
            }
            $("#sem").append(get_option());
            $('#sem').prop('disabled', false);
          }
        }
      });
    });
  
    // use ajax to fill the subject select
    $('#sem').change(function() {
      var semester_id = $(this).val();
      var course_id = $("#course").val();
      console.log(semester_id);
      $.ajax({
        url: "{{route('get.subjects')}}",
        method: "post",
        data: {course_id:course_id,semester_id: semester_id,user_id:{{Auth::user()->id}}},
        success: function(data) {
          console.log(data);
          $('#sub option').remove();
          // make options and add them in the subject select element
          if(data.length > 0){
            for (var i = 0; i < data.length; i++) {
              var option = document.createElement('option');
              option.value = data[i]['subject_id'];
              option.innerHTML = data[i]['subject_name'];
              $("#sub").append(option);
            }
            $("#sub").append(get_option());
            $('#sub').prop('disabled', false);
          }else{
            var option = document.createElement('option');
            option.value = '';
            option.innerHTML = 'No Subjects available in this Semester';
            $("#sub").append(option);
          }
        }
      });
    });
  
  });
  
</script>
