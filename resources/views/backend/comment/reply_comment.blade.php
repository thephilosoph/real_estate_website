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

                            <h6 class="card-title">Reply a Comment</h6>

                            <form class="forms-sample" method="POST" action="{{route('store.reply')}}">
                                <input type="hidden" name="id" value="{{$comment->id}}">
                                <input type="hidden" name="post_id" value="{{$comment->post_id}}">
                                <input type="hidden" name="user_id" value="{{$comment->user_id}}">
                                @csrf

                                <div class="mb-3">
                                    <label for="state_name" class="form-label">User Name : </label>
                                    <code>{{$comment['user']['name']}}</code>
                                </div>

                                <div class="mb-3">
                                    <label for="state_name" class="form-label">Post Title : </label>
                                 <code>{{$comment['post']['post_title']}}</code>
                                </div>

                                <div class="mb-3">
                                    <label for="state_name" class="form-label">Comment Subject :</label>
                                    <code>{{$comment->subject}}</code>
                                </div>

                                <div class="mb-3">
                                    <label for="state_name" class="form-label">Comment Message :</label>
                                    <code>{{$comment->message}}</code>
                                </div>


                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject</label>
                                    <input name="subject" type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" >
                                    @error('subject')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <input name="message" type="text" class="form-control @error('message') is-invalid @enderror" id="message" >
                                    @error('message')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary me-2">Reply</button>

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
