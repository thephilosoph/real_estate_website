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

                            <h6 class="card-title">Add New State</h6>

                            <form class="forms-sample" method="POST" action="{{route('update.state')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$state->id}}">
                                <div class="mb-3">
                                    <label for="state_name" class="form-label">State Name</label>
                                    <input value="{{$state->state_name}}" name="state_name" type="text" class="form-control @error('state_name') is-invalid @enderror" id="state_name" >
                                    @error('state_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label for="photo" class="form-label">State Photo</label>
                                    <input name="photo" type="file" class="form-control" id="image" >
                                </div>

                                <div class="mb-3">
                                    <label for="photoInput" class="form-label"> </label>
                                    <img src="{{asset($state->state_image)}}"
                                         type="file" class="wd-80 rounded-circle" id="showImage" alt="state image">
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
