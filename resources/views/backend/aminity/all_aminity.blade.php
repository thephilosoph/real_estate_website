@extends('admin.admin_dashboard')
@section('admin')


<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route('add.aminity')}}" class="btn btn-inverse-info">Add Aminity</a>
           
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
                    <a href="{{route('edit.aminity',$item->id)}}" class="btn btn-inverse-warning">Edit</a>
                    <a href="{{route('delete.aminity',$item->id)}}" class="btn btn-inverse-danger" id="delete">Delete</a>
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