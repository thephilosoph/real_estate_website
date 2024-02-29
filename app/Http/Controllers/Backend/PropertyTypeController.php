<?php

namespace App\Http\Controllers\Backend;

use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyTypeController extends Controller
{
    public function allType(){
        $types = PropertyType::latest()->get();
        return view('backend.type.all_type',compact('types'));
    }

    public function addType(){

        return view('backend.type.add_type');
    }

    public function storeType(Request $request)
    {
        $request->validate([
            'name'=>"required|unique:property_types|max:200",
            'icon'=>'required'
        ]);

        PropertyType::insert([
            'name'=>$request->name,
            'icon'=>$request->icon
        ]);

        $notification = array([
            "message"=>"property type have created successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->route('all.type')->with($notification);
    }
    public function editType($id){
        $type = PropertyType::find($id);
        return view('backend.type.edit_type',compact('type'));
    }


    public function updateType(Request $request){
       $id = $request->id;

        PropertyType::findOrFail($id)->update([
            'name'=>$request->name,
            'icon'=>$request->icon
        ]);

        $notification = array([
            "message"=>"property type have created successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->route('all.type')->with($notification);
    }
    
    public function deleteType($id){


        PropertyType::findOrFail($id)->delete();

        $notification = array([
            "message"=>"property type have deleted successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->back()->with($notification);
    }
    
    
}
