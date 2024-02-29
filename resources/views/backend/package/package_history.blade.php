@extends('admin.admin_dashboard')
@section('admin')


<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route('add.property')}}" class="btn btn-inverse-info">Add Property</a>
           
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">Package History</h6>
     <div class="table-responsive">
      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th>SL</th>
            <th>Image</th>
            <th>Name</th>
            <th>Package</th>
            <th>Invoice</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($packages as $key => $package)
                
            <tr>
                <td>{{$key+1}}</td>
                <td><img src="{{(!empty($package['user']['photo'])) ? url('uploade/agent_images/'.$package['user']['photo']) : url('uploade/no_image.jpg')}}" style="width:70px; height:40px;"  ></td>
                <td>{{$package->user->name}}</td>
                <td>{{$package->name}}</td>
                <td>{{$package->invoice}}</td>
                <td>{{$package->amount}}</td>
                <td>{{$package->created_at->format('l d M Y')}}</td>
                
                <td>
                    <a href="{{route('package.invoice',$package->id)}}" class="btn btn-inverse-info" title="Download"><i data-feather="download"></i></a>
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