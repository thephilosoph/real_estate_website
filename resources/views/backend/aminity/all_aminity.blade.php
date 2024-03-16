@extends('admin.admin_dashboard')
@section('admin')


<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            @if(\Illuminate\Support\Facades\Auth::user()->can('add.amenities'))

            <a href="{{route('add.aminity')}}" class="btn btn-inverse-info">Add Aminity</a>
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
            <th>Aminity Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($aminities as $key => $item)

            <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->name}}</td>
                <td>
                    @if(\Illuminate\Support\Facades\Auth::user()->can('edit.amenities'))
                    <a href="{{route('edit.aminity',$item->id)}}" class="btn btn-inverse-warning">Edit</a>
                    @endif
                        @if(\Illuminate\Support\Facades\Auth::user()->can('delete.amenities'))
                    <a href="{{route('delete.aminity',$item->id)}}" class="btn btn-inverse-danger" id="delete">Delete</a>
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
