@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>





<div class="page-content">

    
    <div class="row profile-body">

      <!-- middle wrapper start -->
      <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row"> 
            <div class="card">
                <div class="card-body">
  
                                  <h6 class="card-title">Add New Type</h6>
  
                                  <form class="forms-sample" method="POST" action="{{route('update.type')}}">
                                    @csrf
                                      <input hidden type="text" name="id" id="id" value="{{$type->id}}">
                                      <div class="mb-3">
                                          <label for="name" class="form-label">Type Name</label>
                                          <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{$type->name}}" >
                                          @error('name')
                                          <span class="text-danger">{{$message}}</span>
                                          @enderror
                                      </div>
                                      
                       
                                      <div class="mb-3">
                                        <label for="icon" class="form-label">Type Icon</label>
                                        <input name="icon" type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" value="{{$type->icon}}">
                                        @error('icon')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                      
                                      
                                      <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                                      
                                  </form>
  
                </div>
              </div>
  
        </div>
      </div>

    </div>

        </div>

<script type="text/javascript">
$(document).ready(function () {
  $('#image').change(function (e) {
var reader = new FileReader();
reader.onload = function(e){
  $("#showImage").attr('src',e.target.result);
}
reader.readAsDataURL(e.target.files['0']);
  })
})
</script>



@endsection