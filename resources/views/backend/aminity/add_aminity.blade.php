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
  
                                  <h6 class="card-title">Add New Aminity</h6>
  
                                  <form id="myForm" class="forms-sample" method="POST" action="{{route('store.aminity')}}">
                                    @csrf
                                      <div class="form-group mb-3">
                                          <label for="name" class="form-label">Aminity Name</label>
                                          <input name="name" type="text" class="form-control" id="name" >
                                        
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
                          required : 'Please Enter Aminity Name',
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