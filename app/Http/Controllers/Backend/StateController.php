<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class StateController extends Controller
{
    public function allState() {
        $states = State::latest()->get();
        return view('backend.state.all_state',compact('states'));
    }

    public function addState(){

        return view('backend.state.add_state');
    }

    public function storeState(Request $request)
    {

        $image = $request->file('photo');
        $generatedName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save(public_path('/uploade/state/' . $generatedName));
        $url = '/uploade/state/' . $generatedName;

        if(State::insert([
            'state_name'=>$request->state_name,
            'state_image'=>$url
        ])){

            $notification = array([
                "message"=>"State have created successfully",
                "alert-type"=>"success",
            ]);

            return redirect()->route('all.state')->with($notification);
        }

        $notification = array([
            "message"=>"State haven't been created",
            "alert-type"=>"danger",
        ]);

        return redirect()->route('all.state')->with($notification);
    }
    public function editState($id){
        $state = State::findOrFail($id);
        return view('backend.state.edit_state',compact('state'));
    }


    public function updateState(Request $request){
        $id = $request->id;

        if ($image = $request->file('photo')) {
            $generatedName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(370, 250)->save(public_path('/uploade/state/' . $generatedName));
            $url = '/uploade/state/' . $generatedName;

        if(State::findOrFail($id)->update([
            'state_name'=>$request->state_name,
            'state_image'=>$url
        ])) {
            $notification = array([
                "message"=>"state have updated successfully",
                "alert-type"=>"success",
            ]);

            return redirect()->route('all.state')->with($notification);
        }
        }
        State::findOrFail($id)->update([
            'state_name'=>$request->state_name,
        ]);
        $notification = array([
            "message"=>"state have updated successfully",
            "alert-type"=>"success",
        ]);
        return redirect()->route('all.state')->with($notification);
    }

    public function deleteState($id){


        $state = State::findOrFail($id);

        $img = '.'.$state->state_image;
//        dd ($img)   ;
        unlink($img);
        $state->delete();

        $notification = array([
            "message"=>"state have deleted successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->back()->with($notification);
    }
}
