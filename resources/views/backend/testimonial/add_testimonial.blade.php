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

                            <h6 class="card-title">Add New Testimonial</h6>

                            <form class="forms-sample" method="POST" action="{{route('store.testimonial')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Testimonial Name</label>
                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" >
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="position" class="form-label">Testimonial Position</label>
                                    <input name="position" type="text" class="form-control @error('position') is-invalid @enderror" id="position" >
                                    @error('position')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Testimonial Message</label>
                                        <textarea rows="3" class="form-control" name="message" >
                                    </textarea>
                                    </div>
                                </div><!-- Col -->

                                <div class="mb-3">
                                    <label for="photo" class="form-label">Photo</label>
                                    <input name="photo" type="file" class="form-control" id="image" >
                                </div>

                                <div class="mb-3">
                                    <label for="photoInput" class="form-label"> </label>
                                    <img src="{{url('uploade/no_image.jpg')}}"
                                         type="file" class="wd-80 rounded-circle" id="showImage" alt="Testimonial image">
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
