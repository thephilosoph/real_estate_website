<?php

namespace App\Http\Controllers\Backend;

use App\Exports\PermissionExport;
use App\Http\Controllers\Controller;
use App\Imports\PermissionImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use function PHPUnit\Framework\isNull;


class RoleController extends Controller
{
    public function AllPermission()
    {
        $permissions = Permission::all();
        return view('backend.pages.permission.all_permission',compact('permissions'));
    }

    public function addPermission()
    {
        return view('backend.pages.permission.add_permission');
    }

    public function storePermission(Request $request)
    {
        $permission = Permission::create([
            'name'=>$request->name,
            'groupe_name'=>$request->group_name,
            ]);

        $notification = array([
            "message"=>"permission have created successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->route('all.permission')->with($notification);
    }

    public function editPermission($id)
    {
        $permission = Permission::findOrFail($id);
        return view('backend.pages.permission.edit_permission',compact('permission'));
    }

    public function updatePermission(Request $request)
    {
        $permission = Permission::findOrFail($request->id)->update([
            'name'=>$request->name,
            'groupe_name'=>$request->group_name,
        ]);

        $notification = array([
            "message"=>"permission have updated successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->route('all.permission')->with($notification);
    }


    public function deletePermission($id)
    {
        $permission = Permission::findOrFail($id)->delete();

        $notification = array([
            "message"=>"permission have deleted successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->route('all.permission')->with($notification);
    }


    public function importPermission()
    {
        return view('backend.pages.permission.import_permission');
    }


    public function Export()
    {
        return Excel::download(new PermissionExport, 'permission.xlsx');
    }


    public function Import(Request $request)
    {
        Excel::import(new PermissionImport , $request->file('imported_file'));

        $notification = array([
            "message"=>"permission have imported successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->route('all.permission')->with($notification);
    }




    public function AllRole()
    {
        $roles = Role::all();
        return view('backend.pages.role.all_role',compact('roles'));
    }

    public function addRole()
    {
        return view('backend.pages.role.add_role');
    }

    public function storeRole(Request $request)
    {
        $permission = Role::create([
            'name'=>$request->name,
        ]);

        $notification = array([
            "message"=>"Role have created successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->route('all.role')->with($notification);
    }



    public function editRole($id)
    {
        $role = Role::findOrFail($id);
        return view('backend.pages.role.edit_role',compact('role'));
    }

    public function updateRole(Request $request)
    {
        $role = Role::findOrFail($request->id)->update([
            'name'=>$request->name,
        ]);

        $notification = array([
            "message"=>"role have updated successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->route('all.role')->with($notification);
    }


    public function deleteRole($id)
    {
        $role = Role::findOrFail($id)->delete();

        $notification = array([
            "message"=>"role have deleted successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->route('all.role')->with($notification);
    }

    public function addRolePermission()
    {
        $permission = Permission::all();
        $roles = Role::all();
        $permission_groups = User::getPermissionGroup();
        return view('backend.pages.role_setup.add_role_permission',compact('permission','roles','permission_groups'));
    }

    public function rolePermissionStore(Request $request)
    {
        $data = array();
        $permissions = $request->permission ;
//        dd($permissions);
        foreach ($permissions as $key => $item){
            $data['role_id']= $request->role_id;
            $data['permission_id'] = $item;
            DB::table('role_has_permissions')->insert($data);
        }
        $notification = array([
            "message"=>"role in permission have Added successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->back()->with($notification);
    }

    public function allRolePermission()
    {
        $roles = Role::all();
        return view('backend.pages.role_setup.all_role_permission',compact('roles'));
    }


    public function editRolePermission($id)
    {
        $role = Role::findOrFail($id);
        $permission = Permission::all();
        $permission_groups = User::getPermissionGroup();
        return view('backend.pages.role_setup.edit_role_permission',compact('permission','role','permission_groups'));
    }


    public function updateRolePermission(Request $request ,$id)
    {
        $role = Role::findOrFail($id);
        $permissions = $request->permission ;
//        dd($permissions);

    if (!empty($permissions)){
    $role->syncPermissions($permissions);
    }

        $notification = array([
            "message"=>"role in permission have Updated successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->back()->with($notification);
    }


    public function deleteRolePermission($id)
    {
        $role = Role::findOrFail($id);
        if (!is_null($role)){
            $role->delete();
        }


        $notification = array([
            "message"=>"role in permission have deleted successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->back()->with($notification);
    }
}
