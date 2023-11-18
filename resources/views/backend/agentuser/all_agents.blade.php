@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route('add.agent')}}" class="btn btn-inverse-info">Add Agent</a>
            
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
            <th>Role</th>
            <th>Status</th>
            <th>Change</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($agents as $key => $agent)
                
            <tr>
                <td>{{$key+1}}</td>
                <td><img src="{{(!empty($user->photo)) ? url('uploade/agent_images/'.$user->photo) : url('uploade/no_image.jpg')}}" style="width:70px; height:40px;"  ></td>
                <td>{{$agent->name}}</td>
                <td>{{$agent->role}}</td>
                <td>
                    @if ($agent->status == 'active')
                        <span class="badge rounded-pill bg-success">Active</span>
                    @else
                    <span class="badge rounded-pill bg-danger">InActive</span>
                    @endif
                   </td>
                   <td>
                    <input type="checkbox"  data-id="{{$agent->id}}" class="toggle-class" 
                    data-onstyle="success" data-offstyle="dander" 
                    data-toggle="toggle" data-on="active" data-off="inactive" {{$agent->status ? 'checked' : ''}}>
                   </td>
                
                
                <td>
                    {{-- <a href="{{route('show.property',$item->id)}}" class="btn btn-inverse-info" title="Details"><i data-feather="eye"></i></a> --}}
                    <a href="{{route('edit.agent',$agent->id)}}" class="btn btn-inverse-warning" title="Edite"><i data-feather="edit"></i></a>
                    <a href="{{route('delete.agent',$agent->id)}}" class="btn btn-inverse-danger" id="delete" title="Delete"><i data-feather="trash-2"></i></a>
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


<script type="text/javascript">
  $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var user_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeStatus',
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              // console.log(data.success)

                // Start Message 

            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  icon: 'success', 
                  showConfirmButton: false,
                  timer: 3000 
            })
            if ($.isEmptyObject(data.error)) {
                    
                    Toast.fire({
                    type: 'success',
                    title: data.success, 
                    })

            }else{
               
           Toast.fire({
                    type: 'error',
                    title: data.error, 
                    })
                }

              // End Message   


            }
        });
    })
  })
</script>

@endsection