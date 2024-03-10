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

                            <h6 class="card-title">Update smtp Setting</h6>

                            <form id="myForm" class="forms-sample" method="POST" action="{{route('update.smtp.setting')}}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Mailer</label>
                                    <input name="mailer" type="text" class="form-control" value="{{$setting->mailer}}" >
                                </div>

                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Host</label>
                                    <input name="host" type="text" class="form-control"  value="{{$setting->host}}" >
                                </div>

                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Post</label>
                                    <input name="post" type="text" class="form-control" value="{{$setting->post}}" >
                                </div>

                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Username</label>
                                    <input name="username" type="text" class="form-control" value="{{$setting->username}}" >
                                </div>

                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Password</label>
                                    <input name="password" type="text" class="form-control" value="{{$setting->password}}" >
                                </div>

                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Encryption</label>
                                    <input name="encryption" type="text" class="form-control" value="{{$setting->encryption}}" >
                                </div>

                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">From Address</label>
                                    <input name="from_address" type="text" class="form-control" value="{{$setting->from_address}}" >
                                </div>

                                <button type="submit" class="btn btn-primary me-2">Save Changes</button>

                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>


@endsection
