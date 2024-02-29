<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Compare;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{
    
    public function addToCompare(Request $request, $id){

        if (Auth::check()) {
            $exists = Compare::where('user_id',Auth::id())->where('property_id',$id)->first();
            if (!$exists) {
                Compare::insert([
                    "user_id"=> Auth::id(),
                    "property_id"=>$id,
                ]);
                return response()->json(['success'=>"Successfully Added To compare list"]);
            }else{
                return response()->json(['error'=>"the property is already on your compare list"]);

            }
        }else{
            return response()->json(['error'=>"you have to be logged in first"]);

        }
    }




    public function userCompare()
    {
        // $user = Auth::user();
        return view('frontend.dashboard.compare');
    }



    public function getCompareProperty() {

    $compare = Compare::with('property')->where('user_id',Auth::user()->id)->latest()->get();
    return response()->json($compare);   
    
    }


    
    public function compareRemove($id) {
        Compare::where('user_id',Auth::id())->where('id',$id)->delete();
        return \response()->json(['success'=>'successfully Compare remove']);
    }
}
