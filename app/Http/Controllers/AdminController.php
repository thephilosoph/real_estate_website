<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        return view("admin.index");
    }


    public function login()
    {
        return view("admin.login");
    }

    public function adminProfile()
    {
        $user = Auth::user();
        // $data = User::find($id);
        // dd($data);
        return view('admin.profile_view',compact('user'));
    }

     /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function update(Request $request){
        $user = Auth::user();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->address = $request->address;


        if ($request->file('photo')) {
            $file  = $request->file('photo');
            @unlink(public_path('uploade/admin_images'.$user->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploade/admin_images'),$filename);
            $user->photo = $filename;
        }

        $user->save();
        $notification = array(
            "message" => "Admin Profile Updated Successfully",
            "alert-type"=>"success",
        );
        return redirect()->back()->with($notification);
    }


    public function editPassword(){

        $user = Auth::user();

        return view('admin.change_password',compact('user'));
    }

    public function updatePassword(Request $request){

        $request->validate([
            'old_password'=>"required",
            'new_password'=>"required|confirmed",
        ]);
        $user = Auth::user();
        if (!Hash::check($request->old_password, $user->password)) {
            $notification = array([
                "message"=>"Old password is invalid",
                "alert-type"=>"error",
            ]);
            return redirect()->back()->with($notification);
        }
        $user->password = Hash::make($request->new_password);
        $user->update();
        $notification = array([
            "message"=>"password have changed successfully",
            "alert-type"=>"success",
        ]);
        return redirect()->back()->with($notification);

    }



    public function getAgents(){
        $agents = User::where('role','agent')->get();
        return view('backend.agentuser.all_agents' , compact('agents'));
    }
    public function addAgent(){

        return view('backend.agentuser.add_agent' );
    }

    public function storeAgent(Request $request){
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'agent',
            'status' => 'active',
        ]);


        $notification = array([
            "message"=>"Agent have Added successfully",
            "alert-type"=>"success",
        ]);
        return redirect()->route('all.agent')->with($notification);
    }


    public function editAgent($id){
        $agent = User::findOrFail($id);
        return view('backend.agentuser.edit_agent',compact('agent'));
    }



    public function updateAgent(Request $request){
        $user = User::findOrFail($request->id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);


        $notification = array([
            "message"=>"Agent have Updated successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->route('all.agent')->with($notification);
    }


    public function deleteAgent($id)
    {
        $user = User::findOrFail($id)->delete();

        $notification = array([
            "message"=>"Agent have deleted successfully",
            "alert-type"=>"success",
        ]);
        return redirect()->back()->with($notification);

    }


    public function changeStatus(Request $request)
    {
        $user = User::find($request->user_id)->update([
            'status' => $request->status,
        ]);
        return response()->json(['success'=>'status changed successfully']);
    }


    public function allAdmin()
    {
        $admins = User::where('role','admin')->get();
        return view('backend.pages.admin.all_admin',compact('admins'));
    }

    public function addAdmin()
    {
        $roles = Role::all();
        return view('backend.pages.admin.add_admin',compact('roles'));
    }

    public function storeAdmin(Request $request)
    {
        $user = new User();
        $user->username = $request->username ;
        $user->name = $request->name ;
        $user->email = $request->email ;
        $user->phone = $request->phone ;
        $user->address = $request->address ;
        $user->password = Hash::make($request->password) ;
        $user->role = 'admin' ;
        $user->status = 'active' ;

        $user->save();

        if ($request->role_id)
        {
            $user->assignRole($request->role_id);
        }

        $notification = array([
            "message"=>"Admin have created successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->route('all.admin')->with($notification);
    }



    public function editAdmin($id)
    {
        $admin = User::findOrFail($id);
        $roles = Role::all();
        return view('backend.pages.admin.edit_admin',compact('roles','admin'));
    }


    public function updateAdmin(Request $request)
    {
        $user =  User::findOrFail($request->id);
        $user->username = $request->username ;
        $user->name = $request->name ;
        $user->email = $request->email ;
        $user->phone = $request->phone ;
        $user->address = $request->address ;
        $user->password = Hash::make($request->password) ;
        $user->update();

        if($user->roles()){
        $user->roles()->detach();
        }
        if ($request->role_id)
        {
            $user->assignRole($request->role_id);
        }

        $notification = array([
            "message"=>"Admin have Updated successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->route('all.admin')->with($notification);
    }

    public function deleteAdmin($id)
    {
        $user = User::findOrFail($id);
        if (!is_null($user)){
            $user->delete();
        }

        $notification = array([
            "message"=>"Admin have Deleted successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->back()->with($notification);

    }
}
