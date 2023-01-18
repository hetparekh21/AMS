{{-- class modal --}}
<div class="modal fade" id='{{$modalname}}' tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">{{$title}}</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <form action="{{$action}}" method="POST" >
            @csrf
            {{-- Course Dropdown --}}
          <div class="row">
            <div class="col mb-3">
              <label for="nameBasic" class="form-label">Course</label>
                <select class="form-control" name="course_{{$name}}" id="course" required>
                  <option selected disabled>Select</option>
                </select>
                <span class="text-danger">
                  @error('course_'.$name)
                    {{$message}}
                  @enderror
              </span>
            </div>
          </div>

          {{-- Sem Dropdown --}}
          <div class="row">
            <div class="col mb-3">
              <label for="nameBasic" class="form-label">Semester</label>
                <select class="form-control" name="semester_{{$name}}" id="sem" disabled required>
                   <option selected disabled>Select</option>
                </select>
                <span class="text-danger">
                  @error('semester_'.$name)
                    {{$message}}
                  @enderror
              </span>
            </div>
          </div>

          {{-- Subject Dropdown --}}
          <div class="row">
            <div class="col mb-3">
              <label for="nameBasic" class="form-label">Subject</label>
                <select class="form-control" name="subject_{{$name}}" id="sub" disabled required>
                   <option selected disabled>Select</option>
                </select>
                <span class="text-danger">
                  @error('subject_'.$name)
                    {{$message}}
                  @enderror
              </span>
            </div>
          </div>

          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-primary">{{$button}}</button>
        </form>
        </div>
      </div>
    </div>
  </div>