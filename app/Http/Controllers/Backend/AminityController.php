<?php

namespace App\Http\Controllers\Backend;

use App\Models\Aminity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AminityController extends Controller
{
    public function allAminity(){
        $aminities = Aminity::latest()->get();
        return view('backend.aminity.all_aminity',compact('aminities'));
    }

    public function addAminity(){

        return view('backend.aminity.add_aminity');
    }

    public function storeAminity(Request $request)
    {
        $request->validate([
            'name'=>"required|unique:aminities|max:200",
        ]);

        Aminity::insert([
            'name'=>$request->name,
        ]);

        $notification = array([
            "message"=>"property Aminity have created successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->route('all.aminity')->with($notification);
    }
    public function editAminity($id){
        $aminity = Aminity::find($id);
        return view('backend.aminity.edit_aminity',compact('aminity'));
    }


    public function updateAminity(Request $request){
       $id = $request->id;

        Aminity::findOrFail($id)->update([
            'name'=>$request->name,
        ]);

        $notification = array([
            "message"=>"property aminity have updated successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->route('all.aminity')->with($notification);
    }
    
    public function deleteAminity($id){


        Aminity::findOrFail($id)->delete();

        $notification = array([
            "message"=>"property Aminity have deleted successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->back()->with($notification);
    }
}
