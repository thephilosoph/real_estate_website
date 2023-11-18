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
  
                                  <h6 class="card-title">Update Agent</h6>
  
                                  <form id="myForm" class="forms-sample" method="POST" action="{{route('update.agent')}}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$agent->id}}">
                                      <div class="form-group mb-3">
                                          <label for="name" class="form-label">Agent Name</label>
                                          <input name="name" value="{{$agent->name}}" type="text" class="form-control" id="name" >
                                        
                                      </div>
                                      <div class="form-group mb-3">
                                        <label for="email" class="form-label">Agent Email</label>
                                        <input name="email" value="{{$agent->email}}" type="text" class="form-control" id="email" >
                                      
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="username" class="form-label">Agent Username</label>
                                        <input name="username" value="{{$agent->username}}" type="text" class="form-control" id="username" >
                                      
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                          <label for="phone" class="form-label">Agent Phone</label>
                                          <input name="phone" value="{{$agent->phone}}" type="text" class="form-control" id="phone" >
                                        
                                      </div>

                                      <div class="form-group mb-3">
                                        <label for="address" class="form-label">Agent Address</label>
                                        <input name="address" value="{{$agent->address}}" type="text" class="form-control" id="address" >
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
          $(document).ready(function (){
              $('#myForm').validate({
                  rules: {
                    name: {
                          required : true,
                      }, 
                      
                  },
                  messages :{
                    name: {
                          required : 'Please Enter Agent Name',
                      }, 
                       
      
                  },
                  errorElement : 'span', 
                  errorPlacement: function (error,element) {
                      error.addClass('invalid-feedback');
                      element.closest('.form-group').append(error);
                  },
                  highlight : function(element, errorClass, validClass){
                      $(element).addClass('is-invalid');
                  },
                  unhighlight : function(element, errorClass, validClass){
                      $(element).removeClass('is-invalid');
                  },
              });
          });
          
      </script>


@endsection