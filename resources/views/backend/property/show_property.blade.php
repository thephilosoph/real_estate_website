@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-12 col-xl-12 middle-wrapper">

        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
                        <h6 class="card-title">Property Details</h6>
                        
                        <div class="table-responsive">
                                <table class="table table-striped">
                                    
                                    <tbody>
                                        
                                        <tr>
                                            <th>Property Name</th>
                                            <td><code>{{$property->property_name}}</code></td>
                                        </tr>
                                        <tr>
                                            <th>Property Status</th>
                                            <td><code>{{$property->property_status}}</code></td>
                                        </tr>
                                   
                                        <tr>
                                            <th>Property Min Price</th>
                                            <td><code>{{$property->min_price}}</code></td>
                                        </tr>

                                        <tr>
                                            <th>Property Max Price</th>
                                            <td><code>{{$property->max_price}}</code></td>
                                        </tr>


                                        <tr>
                                            <th>Property Bedrooms</th>
                                            <td><code>{{$property->bedrooms}}</code></td>
                                        </tr>


                                        <tr>
                                            <th>Property Bathrooms</th>
                                            <td><code>{{$property->bathrooms}}</code></td>
                                        </tr>


                                        <tr>
                                            <th>Property Garage</th>
                                            <td><code>{{$property->garage}}</code></td>
                                        </tr>



                                        <tr>
                                            <th>Property Garage Size</th>
                                            <td><code>{{$property->garage_size}}</code></td>
                                        </tr>



                                        <tr>
                                            <th>Property Address</th>
                                            <td><code>{{$property->address}}</code></td>
                                        </tr>



                                        <tr>
                                            <th>Property City</th>
                                            <td><code>{{$property->city}}</code></td>
                                        </tr>



                                        <tr>
                                            <th>Property State</th>
                                            <td><code>{{$property->state}}</code></td>
                                        </tr>

                                        <tr>
                                            <th>Property Postal Code</th>
                                            <td><code>{{$property->postal_code}}</code></td>
                                        </tr>

                                        <tr>
                                            <th>Property Thumbnail</th>
                                            <td><img src="{{asset($property->property_thumbnail)}}" style="width: 100px; height: 70px;"></td>
                                        </tr>
                                       
                                       
                                        <tr>
                                        <th>Status</th>
                                        <td>
                                            @if ($property->status == 1)
                                                <span class="badge rounded-pill bg-success">Active</span>
                                            @else
                                            <span class="badge rounded-pill bg-danger">InActive</span>
                                            @endif
                                           </td>
                                        </tr>


                                        <tr>
                                            <th>Property Status</th>
                                            <td><code>{{$property->property_status}}</code></td>
                                        </tr>
                                       
                                    </tbody>
                                </table>
                        </div>
      </div>
    </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
                        <h6 class="card-title">Hoverable Table</h6>
                        <div class="table-responsive">
                                <table class="table table-striped">
                                    
                                    <tbody>

                                        <tr>
                                            <th>Property Code</th>
                                            <td><code>{{$property->property_code}}</code></td>
                                        </tr>

                                        <tr>
                                            <th>Property Size</th>
                                            <td><code>{{$property->property_size}}</code></td>
                                        </tr>


                                        <tr>
                                            <th>Property Video</th>
                                            <td><code>{{$property->property_video}}</code></td>
                                        </tr>


                                        <tr>
                                            <th>Property Neighborhood</th>
                                            <td><code>{{$property->neighborhood}}</code></td>
                                        </tr>


                                        <tr>
                                            <th>Property Latitude</th>
                                            <td><code>{{$property->latitude}}</code></td>
                                        </tr>

                                        <tr>
                                            <th>Property Longtude</th>
                                            <td><code>{{$property->longtude}}</code></td>
                                        </tr>

                                        <tr>
                                            <th>Property Type</th>
                                            <td><code>{{$property['type']['name']}}</code></td>
                                        </tr>

                                        <tr>
                                            <th>Property Aminities</th>
                                            <td>
                                                <select name="aminities_id[]" class="js-example-basic-multiple form-select" multiple="multiple" data-width="100%">
                                                    @foreach ($aminities as $aminity)
                                                    <option {{(in_array($aminity->id,$property_aminities))  ? 'selected' :""}} value="{{$aminity->id}}">{{$aminity->name}}</option>
                                                    @endforeach
                                                </select>       
                                            </td>
                                        </tr>
                                       
                                        


                                        <tr>
                                            <th>Property Agent</th>
                                            <td>

                                                @if ($property->agent_id==NULL)
                                                    <code>Admin</code>
                                                @else
                                                <code>{{$property['user']['name']}}</code>
                                                    
                                                @endif
        
                                            </td>
                                        </tr>

                                       
                                    </tbody>
                                </table>

                                <br>
                                <br>
                                @if ($property->status == 1)
                                    <a href="{{route('inactive.property',$property->id)}}" class="btn btn-danger">Inactive</a>
                                @else
                                <a href="{{route('active.property',$property->id)}}" class="btn btn-success">Active</a>
                                @endif
                        </div>
      </div>
    </div>
            </div>
        </div>

      
      </div>
    </div>
</div>
@endsection