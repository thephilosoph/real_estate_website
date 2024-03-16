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

                            <h6 class="card-title">Add New Permission</h6>

                            <form id="myForm" class="forms-sample" method="POST" action="{{route('update.permission')}}">
                                @csrf

                                <input type="hidden" name="id" value="{{$permission->id}}">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Permission Name</label>
                                    <input name="name" type="text" class="form-control" id="name" value="{{$permission->name}}">
                                </div>


                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Group Name</label>
                                    <select name="group_name" class="form-select" id="form-select">
                                        <option disabled>Select Group</option>
                                        <option {{$permission->groupe_name == 'type' ? 'selected':''}} value="type">Property Type</option>
                                        <option {{$permission->groupe_name == 'amenities' ? 'selected':''}} value="amenities">Amenities</option>
                                        <option {{$permission->groupe_name == 'state' ? 'selected':''}} value="state">State</option>
                                        <option {{$permission->groupe_name == 'property' ? 'selected':''}} value="property">Property</option>
                                        <option {{$permission->groupe_name == 'history' ? 'selected':''}} value="history">Package History</option>
                                        <option {{$permission->groupe_name == 'message' ? 'selected':''}} value="message">Property Message</option>
                                        <option {{$permission->groupe_name == 'testimonial' ? 'selected':''}} value="testimonial">Testimonial</option>
                                        <option {{$permission->groupe_name == 'agent' ? 'selected':''}} value="agent">Manage Agent</option>
                                        <option {{$permission->groupe_name == 'category' ? 'selected':''}} value="category">Blog Category</option>
                                        <option {{$permission->groupe_name == 'post' ? 'selected':''}} value="post">Blog Post</option>
                                        <option {{$permission->groupe_name == 'comment' ? 'selected':''}} value="comment">Blog Comment</option>
                                        <option {{$permission->groupe_name == 'smtp' ? 'selected':''}} value="smtp">SMTP Setting</option>
                                        <option {{$permission->groupe_name == 'site' ? 'selected':''}} value="site">Site Setting</option>
                                        <option {{$permission->groupe_name == 'role' ? 'selected':''}} value="role">Role & Permission</option>
                                    </select>
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
