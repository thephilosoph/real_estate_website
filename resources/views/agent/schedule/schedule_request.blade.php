@extends('agent.agent_dashboard')
@section('agent')


    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">

            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All schedule</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>User</th>
                                    <th>Property</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($messages as $key => $message)

                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$message['user']['name']}}</td>
                                        <td>{{$message['property']['property_name']}}</td>
                                        <td>{{$message->tour_date}}</td>
                                        <td>{{$message->tour_time}}</td>
                                        <td>
                                            @if ($message->status == 1)
                                                <span class="badge rounded-pill bg-success">Conformed</span>
                                            @else
                                                <span class="badge rounded-pill bg-danger">Pending</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{route('show.details.schedule',$message->id)}}" class="btn btn-inverse-info" title="Details"><i data-feather="eye"></i></a>
                                            <a href="{{route('delete.agent.property',$message->id)}}" class="btn btn-inverse-danger" id="delete" title="Delete"><i data-feather="trash-2"></i></a>
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
