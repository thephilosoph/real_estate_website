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

                            <h6 class="card-title">Update Site Setting</h6>

                            <form id="myForm" class="forms-sample" method="POST" action="{{route('update.site.setting')}}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="company_address" class="form-label">Company Address</label>
                                    <input name="company_address" type="text" class="form-control"  value="{{$setting->company_address}}" >
                                </div>

                                <div class="form-group mb-3">
                                    <label for="support_phone" class="form-label">Support Phone</label>
                                    <input name="support_phone" type="text" class="form-control"  value="{{$setting->support_phone}}" >
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input name="email" type="text" class="form-control"  value="{{$setting->email}}" >
                                </div>

                                <div class="form-group mb-3">
                                    <label for="facebook" class="form-label">Facebook</label>
                                    <input name="facebook" type="text" class="form-control"  value="{{$setting->facebook}}" >
                                </div>


                                <div class="form-group mb-3">
                                    <label for="twitter" class="form-label">Twitter</label>
                                    <input name="twitter" type="text" class="form-control"  value="{{$setting->twitter}}" >
                                </div>


                                <div class="form-group mb-3">
                                    <label for="copyright" class="form-label">CopyRight</label>
                                    <input name="copyright" type="text" class="form-control"  value="{{$setting->copyright}}" >
                                </div>


                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo</label>
                                    <input name="logo" type="file" class="form-control" id="image" >
                                </div>

                                <div class="mb-3">
                                    <label for="photoInput" class="form-label"> </label>
                                    <img src="{{asset($setting->logo)}}"
                                         type="file" class="wd-80 rounded-circle" id="showImage" alt="profile image">
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
