@extends('admin.admin_dashboard')
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <style type="text/css">
        .form-check-label{
            text-transform: capitalize;
        }
    </style>
    <div class="page-content">


        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Add New Permission</h6>

                            <form id="myForm" class="forms-sample" method="POST" action="{{route('role.permission.update',$role->id)}}">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Role Name</label>
                                    <h3>{{$role->name}}</h3>
                                </div>

                                <div class="form-check mb-2">
                                    <input type="checkbox" name="" id="checkDefaultMain" class="form-check-input" >
                                    <label class="form-check-label" for="checkDefaultMain" > Permission All</label>
                                </div>


                                <br>
                                @foreach($permission_groups as $permission_group)
                                    <div class="row">
                                        <div class="col-3">

                                            @php

                                                $permissions = App\Models\User::getPermissionByGroupName($permission_group->groupe_name);
                                            @endphp

                                            <div class="form-check mb-2">
                                                <input type="checkbox" id="checkDefault" class="form-check-input" {{App\Models\User::roleHasPermissions($role,$permissions) ? 'checked' : ''}}>
                                                <label class="form-check-label" for="checkDefault" > {{$permission_group->groupe_name}}</label>
                                            </div>
                                        </div>
                                        <div class="col-9">

                                            @foreach($permissions as $permission)
                                                <div class="form-check mb-2">
                                                    <input  value="{{$permission->name}}" type="checkbox" name="permission[]"
                                                            id="checkDefault{{$permission->id}}" class="form-check-input"
                                                            {{$role->hasPermissionTo($permission->name) ? 'checked' : ''}}
                                                    >
                                                    <label class="form-check-label" for="checkDefault{{$permission->id}}" > {{$permission->name}}</label>
                                                </div>
                                            @endforeach
                                            <br>
                                        </div>
                                    </div>
                                @endforeach

                                <button type="submit" class="btn btn-primary me-2">Save Changes</button>

                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <script type="text/javascript">
        $('#checkDefaultMain').click(function (){
            if ($(this).is(":checked")){
                $('input[type=checkbox]').prop('checked',true);
            }else{
                $('input[type=checkbox]').prop('checked',false);
            }
        })

    </script>


@endsection
