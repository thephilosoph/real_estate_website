@extends('admin.admin_dashboard')
@section('admin')


    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                @if(\Illuminate\Support\Facades\Auth::user()->can('add.testimonial'))
                <a href="{{route('add.testimonial')}}" class="btn btn-inverse-info">Add Testimonial</a>
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
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($testimonials as $key => $item)

                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->position}}</td>
                                        <td><img src="{{asset($item->image)}}" style="width:70px; height:40px;"></td>
                                        <td>
                                            @if(\Illuminate\Support\Facades\Auth::user()->can('edit.testimonial'))
                                            <a href="{{route('edit.testimonial',$item->id)}}" class="btn btn-inverse-warning">Edit</a>
                                            @endif
                                                @if(\Illuminate\Support\Facades\Auth::user()->can('delete.testimonial'))
                                            <a href="{{route('delete.testimonial',$item->id)}}" class="btn btn-inverse-danger" id="delete">Delete</a>
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
