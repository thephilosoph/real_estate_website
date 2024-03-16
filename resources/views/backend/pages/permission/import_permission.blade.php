@extends('admin.admin_dashboard')
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{route('export')}}" class="btn btn-inverse-danger">Download Xlsx</a>
            </ol>
        </nav>


        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Add New Permission</h6>

                            <form id="myForm" class="forms-sample" method="POST" action="{{route('import')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="imported_file" class="form-label">Permission Name</label>
                                    <input name="imported_file" type="file" class="form-control"  >
                                </div>

                                <button type="submit" class="btn btn-inverse-warning me-2">Upload</button>

                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>



@endsection
