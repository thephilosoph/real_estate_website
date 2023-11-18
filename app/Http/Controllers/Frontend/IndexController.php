<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Aminity;
use App\Models\Facility;
use App\Models\Property;
use App\Models\MultiImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\IndexController;

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
        return \view('frontend.property.property_details',\compact('property','multiImages','property_aminities' ,'aminities','facilities','relatedProperty'));
    }
}
