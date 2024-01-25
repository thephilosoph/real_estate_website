<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Aminity;
use App\Models\Facility;
use App\Models\Property;
use App\Models\MultiImage;
use Illuminate\Http\Request;
use App\Models\PropertyMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function propertyDetails($id,$slug)
    {
        $property = Property::findOrFail($id);
        $multiImages = MultiImage::where('property_id',$id)->get();
        $property_aminities = explode(',', $property->aminities_id);
        $aminities = Aminity::latest()->get();
        $facilities = Facility::where('property_id', $id)->get();
        $relatedProperty = Property::where('type_id',$property->type_id)->where('id','!=',$property->id)->orderBy('id','DESC')->limit(3)->get();
        $id = Auth::user()->id; 
        $userData = User::find($id); 
        return \view('frontend.property.property_details',\compact('property','multiImages','property_aminities' ,'aminities','facilities','relatedProperty','userData'));
    }
    public function propertyMessage(Request $request) {
        $pid = $request->property_id;
        $aid = $request->agent_id; 
        $id = Auth::user()->id; 

        if(Auth::check()){
            PropertyMessage::insert([
                "user_id"=> $id,
                "property_id"=> $request->property_id,
                "agent_id"=> $request->agent_id,
                "msg_name"=> $request->msg_name,
                "msg_email"=> $request->msg_email,
                "msg_phone"=> $request->msg_phone,
                "message"=> $request->message,
                "created_at"=>Carbon::now(),
            ]);
            $notification = array(
                'message'=>"Message sent successfully",
                "alert_type"=>"success"
            );
            return redirect()->back()->with($notification);
            
        }else{
            $notification = array(
            'message'=>"Login to your Account first",
            "alert_type"=>"error"
        );
            return redirect()->back()->with($notification);
        }
    }
}
