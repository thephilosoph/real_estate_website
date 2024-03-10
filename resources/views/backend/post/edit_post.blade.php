@extends('admin.admin_dashboard')
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>



    <div class="page-content">


        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Edit Post</h6>

                            <form class="forms-sample" method="POST" action="{{route('update.post')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$post->id}}">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Post Title </label>
                                            <input value="{{$post->post_title}}" type="text" name="post_title" class="form-control" placeholder="Enter Post Title">
                                        </div>
                                    </div><!-- Col -->

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Post Category</label>
                                            <div class="mb-3">

                                                <select name="blogcat_id" class="form-select" id="form-select">
                                                    <option selected disabled>Select Status</option>
                                                    @foreach($categories as $category)
                                                        <option {{$post->blogcat_id == $category->id ? 'selected' : ""}} value="{{$category->id}}">{{$category->category_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div><!-- Col -->
                                </div>


                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Short Description</label>
                                        <textarea  rows="3" class="form-control" name="short_desc" >
                                    {{$post->short_desc}}
                                        </textarea>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Long Description</label>
                                        <textarea  class="form-control" name="long_desc" id="tinymceExample" rows="10">{{$post->long_desc}}</textarea>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Post Tags</label>
                                        <input value="{{$post->post_tags}}" name="post_tags" id="tags" value="Realestate," />
                                    </div>
                                </div><!-- Col -->

                                <div class="mb-3">
                                    <label for="photo" class="form-label">State Photo</label>
                                    <input name="post_image" type="file" class="form-control" id="image" >
                                </div>

                                <div class="mb-3">
                                    <label for="photoInput" class="form-label"> </label>
                                    <img src="{{asset($post->post_image)}}"
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
