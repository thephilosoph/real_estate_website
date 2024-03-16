@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{route('add.admin')}}" class="btn btn-inverse-info">Add Agent</a>

            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Agents</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($admins as $key => $admin)

                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><img src="{{(!empty($admin->photo)) ? url('uploade/admin_images/'.$admin->photo) : url('uploade/no_image.jpg')}}" style="width:70px; height:40px;"  ></td>
                                        <td>{{$admin->name}}</td>
                                        <td>{{$admin->email}}</td>
                                        <td>{{$admin->phone}}</td>
                                        <td>
                                            @foreach($admin->roles as $role)
                                                <span class="badge rounded-pill bg-danger">{{$role->name}}</span>
                                            @endforeach
                                        </td>



                                        <td>
                                            {{-- <a href="{{route('show.property',$item->id)}}" class="btn btn-inverse-info" title="Details"><i data-feather="eye"></i></a> --}}
                                            <a href="{{route('edit.admin',$admin->id)}}" class="btn btn-inverse-warning" title="Edite"><i data-feather="edit"></i></a>
                                            <a href="{{route('delete.admin',$admin->id)}}" class="btn btn-inverse-danger" id="delete" title="Delete"><i data-feather="trash-2"></i></a>
                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



@endsection
