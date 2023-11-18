@extends('agent.agent_dashboard')
@section('agent')


<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route('add.agent.property')}}" class="btn btn-inverse-info">Add Property</a>
           
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
            <th>Image</th>
            <th>Name</th>
            <th>Type</th>
            <th>Status Type</th>
            <th>City</th>
            <th>Code</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($properties as $key => $property)
                
            <tr>
                <td>{{$key+1}}</td>
                <td><img src="{{asset($property->property_thumbnail)}}" style="width:70px; height:40px;"  ></td>
                <td>{{$property->property_name}}</td>
                <td>{{$property['type']['name']}}</td>
                <td>{{$property->property_status}}</td>
                <td>{{$property->city}}</td>
                <td>{{$property->property_code}}</td>
                <td>
                    @if ($property->status == 1)
                        <span class="badge rounded-pill bg-success">Active</span>
                    @else
                    <span class="badge rounded-pill bg-danger">InActive</span>
                    @endif
                   </td>
                
                <td>
                    <a href="{{route('show.agent.property',$property->id)}}" class="btn btn-inverse-info" title="Details"><i data-feather="eye"></i></a>
                    <a href="{{route('edit.agent.property',$property->id)}}" class="btn btn-inverse-warning" title="Edite"><i data-feather="edit"></i></a>
                    <a href="{{route('delete.agent.property',$property->id)}}" class="btn btn-inverse-danger" id="delete" title="Delete"><i data-feather="trash-2"></i></a>
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