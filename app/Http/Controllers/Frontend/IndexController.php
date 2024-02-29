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
        if (Auth::user()) {
            $id = Auth::user()->id;
            $userData = User::find($id);
            return \view('frontend.property.property_details',\compact('property','multiImages','property_aminities' ,'aminities','facilities','relatedProperty','userData'));
        }
        return \view('frontend.property.property_details',\compact('property','multiImages','property_aminities' ,'aminities','facilities','relatedProperty'));

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


    public function agentDetails($id) {
        $agent = User::findOrFail($id);
        $properties = Property::where('agent_id',$id)->get();
        $featured = Property::where('featured' , 1)->limit(3)->get();
        $forRent = Property::where('property_status' , 'rent')->count();
        $forBuy = Property::where('property_status' , 'buy')->count();
        if($userData = Auth::user()){
        return view('frontend.agent.agent_details',compact('agent','properties','featured','userData','forRent','forBuy'));
        }
        return view('frontend.agent.agent_details',compact('agent','properties','featured','forRent','forBuy'));
    }



    public function agentDetailsMessage(Request $request) {
        $pid = $request->property_id;
        $aid = $request->agent_id;
        $id = Auth::user()->id;

        if(Auth::check()){
            PropertyMessage::insert([
                "user_id"=> $id,
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

    public function rentProperty()
    {
        $properties = Property::where('status',1)->where('property_status' , 'rent')->paginate(3);
//        dd($properties);
        $forRent = Property::where('property_status' , 'rent')->count();
        $forBuy = Property::where('property_status' , 'buy')->count();
        return view('frontend.property.rent_property',compact('properties','forRent','forBuy'));
    }


    public function buyProperty()
    {
        $properties = Property::where('status',1)->where('property_status' , 'buy')->paginate(3);
        $forRent = Property::where('property_status' , 'rent')->count();
        $forBuy = Property::where('property_status' , 'buy')->count();
        return view('frontend.property.buy_property',compact('properties','forRent','forBuy'));
    }
    public function typeProperty($id)
    {
        $properties = Property::where('status',1)->where('type_id' , $id)->get();
        $forRent = Property::where('property_status' , 'rent')->count();
        $forBuy = Property::where('property_status' , 'buy')->count();
        return view('frontend.property.type_property',compact('properties','forRent','forBuy'));
    }


}

