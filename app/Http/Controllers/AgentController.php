<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\Rules\Password;


class AgentController extends Controller
{
    public function agentDashboard()
    {
        return view("agent.index");
    }

    public function login()
    {
        return view("agent.login");
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'agent',
            'status' => 'inactive',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::Agent);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array([
            "message" => "Logged out successfully",
            "alert-type" => "success",
        ]);
        return redirect('/agent/login')->with($notification);
    }


    public function agentProfile()
    {
        $user = Auth::user();
        return view('agent.profile_view', compact('user'));
    }



    public function update(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->address = $request->address;


        if ($request->file('photo')) {
            $file  = $request->file('photo');
            @unlink(public_path('uploade/agent_images' . $user->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploade/agent_images'), $filename);
            $user->photo = $filename;
        }

        $user->save();
        $notification = array(
            "message" => "Agent Profile Updated Successfully",
            "alert-type" => "success",
        );
        return redirect()->back()->with($notification);
    }


    public function editPassword()
    {

        $user = Auth::user();

        return view('agent.change_password', compact('user'));
    }

    public function updatePassword(Request $request)
    {

        $request->validate([
            'old_password' => "required",
            'new_password' => "required|confirmed",
        ]);
        $user = Auth::user();
        if (!Hash::check($request->old_password, $user->password)) {
            $notification = array([
                "message" => "Old password is invalid",
                "alert-type" => "error",
            ]);
            return redirect()->back()->with($notification);
        }
        $user->password = Hash::make($request->new_password);
        $user->update();
        $notification = array([
            "message" => "password have changed successfully",
            "alert-type" => "success",
        ]);
        return redirect()->back()->with($notification);
    }
}
