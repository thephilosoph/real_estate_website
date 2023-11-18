<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function AddToWishList(Request $request, $id){

        if (Auth::check()) {
            $exists = Wishlist::where('user_id',Auth::id())->where('property_id',$id)->first();
            if (!$exists) {
                Wishlist::insert([
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

    public function userWishlist()
    {
        $user = Auth::user();
        return view('frontend.dashboard.wishlist',compact('user'));
    }


public function getWishListProperty()
{
    $wishlist = Wishlist::with('property')->where('user_id',Auth::user()->id)->latest()->get();
    $wishlistcount = Wishlist::count();
    return response()->json(['wishlist'=>$wishlist,'wishlistcount'=>$wishlistcount]);   
}    


function wishlistRemove($id) {
    Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
    return \response()->json(['success'=>'successfully property remove']);
}

}
