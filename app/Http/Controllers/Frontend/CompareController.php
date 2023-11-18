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
                return response()->json(['success'=>"Successfully Added To Wishlist"]);
            }else{
                return response()->json(['error'=>"the property is already on your Wishlist"]);

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
}
