@extends('admin.admin_dashboard')
@section('admin')


    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                @if(\Illuminate\Support\Facades\Auth::user()->can('add.state'))
                <a href="{{route('add.state')}}" class="btn btn-inverse-info">Add State</a>
                @endif
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Data Table</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>State Name</th>
                                    <th>State Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($states as $key => $item)

                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->state_name}}</td>
                                        <td><img src="{{asset($item->state_image)}}" style="width:70px; height:40px;"></td>
                                        <td>
                                            @if(\Illuminate\Support\Facades\Auth::user()->can('edit.state'))
                                            <a href="{{route('edit.state',$item->id)}}" class="btn btn-inverse-warning">Edit</a>
                                            @endif
                                                @if(\Illuminate\Support\Facades\Auth::user()->can('delete.state'))
                                            <a href="{{route('delete.state',$item->id)}}" class="btn btn-inverse-danger" id="delete">Delete</a>
                                                @endif

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
