<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function edit()
    {
        $user= Auth::user();
        return view('frontend.dashboard.edit',compact('user'));
    }



    public function update(Request $request){
        $user = Auth::user();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->address = $request->address;


        if ($request->file('photo')) {
            $file  = $request->file('photo');
            @unlink(public_path('uploade/user_images'.$user->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploade/user_images'),$filename);
            $user->photo = $filename;
        }

        $user->save();
        $notification = array(
            "message" => "User Profile Updated Successfully",
            "alert-type"=>"success",
        );
        return redirect()->back()->with($notification);
    }




     /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function editPassword(){

        $user = Auth::user();
       
        return view('frontend.dashboard.change_password',compact('user'));
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
}
