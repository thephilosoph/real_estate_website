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

                            <h6 class="card-title">Add New Agent</h6>

                            <form id="myForm" class="forms-sample" method="POST" action="{{route('store.admin')}}">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Admin Name</label>
                                    <input name="name" type="text" class="form-control" id="name" >
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Admin Email</label>
                                    <input name="email" type="text" class="form-control" id="email" >

                                </div>
                                <div class="form-group mb-3">
                                    <label for="username" class="form-label">Admin Username</label>
                                    <input name="username" type="text" class="form-control" id="username" >

                                </div>
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">Admin Password</label>
                                    <input name="password" type="password" class="form-control" id="password" >

                                </div>
                                <div class="form-group mb-3">
                                    <label for="phone" class="form-label">Admin Phone</label>
                                    <input name="phone" type="text" class="form-control" id="phone" >

                                </div>

                                <div class="form-group mb-3">
                                    <label for="address" class="form-label">Admin Address</label>
                                    <input name="address" type="text" class="form-control" id="address" >
                                </div>


                                <div class="form-group mb-3">
                                    <label for="role_id" class="form-label">Role</label>
                                    <select name="role_id" class="form-select" id="form-select">
                                        <option selected disabled>Select Group</option>
                                        @foreach($roles as $role)
                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                        @endforeach
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



@endsection
