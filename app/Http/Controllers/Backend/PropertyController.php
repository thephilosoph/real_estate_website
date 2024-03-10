<?php

namespace App\Http\Controllers\Backend;

use App\Models\State;
use App\Models\User;
use App\Models\Aminity;
use App\Models\Facility;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\PackagePlan;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\PropertyMessage;
// use Haruncpi\LaravaelIdGenerator\IdGenerator;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator as IdGenerator;


class PropertyController extends Controller
{

    public function allProperty()
    {
        $properties = Property::latest()->get();
        return view('backend.property.all_properties', compact('properties'));
    }
    public function addProperty()
    {
        $aminities = Aminity::latest()->get();
        $types = PropertyType::latest()->get();
        $states = State::latest()->get();
        $activeAgents = User::where('status', 'active')->where('role', 'agent')->latest()->get();
        return view('backend.property.add_property', compact('states','aminities', 'types', 'activeAgents'));
    }


    public function storeProperty(Request $request)
    {
        $image = $request->file('property_thumbnail');
        $generatedName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save(public_path('/uploade/property/thumbnail/' . $generatedName));
        $url = '/uploade/property/thumbnail/' . $generatedName;
        $aminities  =  implode(',', $request->aminities_id);
        $p_code = IdGenerator::generate(['table' => 'properties', 'field' => 'property_code', 'length' => 5, 'prefix' => 'PC']);

        $property_id = Property::insertGetId([
            'type_id' => $request->type_id,
            'aminities_id' => $aminities,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_code' => $p_code,
            'property_status' => $request->property_status,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,

            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,

            'postal_code' => $request->postal_code,
            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longtude' => $request->longtude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => $request->agent_id,
            'status' => 1,
            'property_thumbnail' => $url,
        ]);


        $images = $request->file('multi_img');
        foreach ($images as $img) {

            $generatedName = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(770, 520)->save(public_path('/uploade/property/multi_images/' . $generatedName));
            $path = '/uploade/property/multi_images/' . $generatedName;
            MultiImage::insert([
                'property_id' => $property_id,
                'photo_name' => $path,
            ]);
        }


        $facilities = Count($request->facility_name);
        if ($request->facility_name != NULL) {
            for ($i = 0; $i < $facilities; $i++) {
                $facility = new Facility();
                $facility->property_id = $property_id;
                $facility->facility_name = $request->facility_name[$i];
                $facility->distance = $request->distance[$i];
                $facility->save();
            }
        }

        $notification = array([
            "message" => "property type have created successfully",
            "alert-type" => "success",
        ]);

        return redirect()->route('all.property')->with($notification);
    }




    public function editProperty($id)
    {
        $states = State::latest()->get();
        $property = Property::find($id);
        $property_aminities = explode(',', $property->aminities_id);
        $multiImages = MultiImage::where('property_id', $id)->get();
        $aminities = Aminity::latest()->get();
        $facilities = Facility::where('property_id', $id)->get();
        $types = PropertyType::latest()->get();
        $activeAgents = User::where('status', 'active')->where('role', 'agent')->latest()->get();
        return view('backend.property.edit_properties', compact('states','property', 'facilities', 'property_aminities', 'aminities', 'types', 'activeAgents', 'multiImages'));
    }



    public function updateProperty(Request $request)
    {
        $aminities = implode(',', $request->aminities_id);
        $property = Property::findOrFail($request->id)->update([
            'type_id' => $request->type_id,
            'aminities_id' => $aminities,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_status' => $request->property_status,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,

            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,

            'postal_code' => $request->postal_code,
            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longtude' => $request->longtude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => $request->agent_id,

        ]);


        $notification = array([
            "message" => "property type have updated successfully",
            "alert-type" => "success",
        ]);

        return redirect()->route('all.property')->with($notification);
    }


    public function updatePropertyThumbnail(Request $request)
    {
        $image = $request->file('property_thumbnail');
        $generatedName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save(public_path('/uploade/property/thumbnail/' . $generatedName));
        $url = '/uploade/property/thumbnail/' . $generatedName;

        if (file_exists($request->old_image)) {
            unlink($request->old_image);
        }
        Property::findOrFail($request->id)->update([
            'property_thumbnail' => $url,
        ]);
        $notification = array([
            "message" => "property Thumnail have updated successfully",
            "alert-type" => "success",
        ]);

        return redirect()->route('all.property')->with($notification);
    }




    public function updatePropertyMultiImage(Request $request)
    {
        foreach ($request->multi_img as $id => $img) {
            $image = MultiImage::findOrFail($id);
            unlink(public_path($image->photo_name));
            $generatedName = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(770, 520)->save(public_path('/uploade/property/multi_images/' . $generatedName));
            $path = '/uploade/property/multi_images/' . $generatedName;

            MultiImage::where('id', $id)->update([
                "photo_name" => $path,
            ]);
        }

        $notification = array([
            "message" => "property multi images have updated successfully",
            "alert-type" => "success",
        ]);

        return redirect()->back()->with($notification);
    }


    public function deletePropertyMultiImage($id)
    {
        $image = MultiImage::findOrFail($id);
        unlink(public_path($image->photo_name));
        $image->delete();
        $notification = array([
            "message" => "property multi images have daleted successfully",
            "alert-type" => "success",
        ]);

        return redirect()->back()->with($notification);
    }


    public function storePropertyMultiImage(Request $request)
    {
        $img = $request->file('multi_img');
        $generatedName = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
        Image::make($img)->resize(770, 520)->save(public_path('/uploade/property/multi_images/' . $generatedName));
        $path = '/uploade/property/multi_images/' . $generatedName;

        MultiImage::insert([
            'property_id' => $request->property_id,
            'photo_name' => $path,
        ]);


        $notification = array([
            "message" => "property multi images have Added successfully",
            "alert-type" => "success",
        ]);

        return redirect()->back()->with($notification);
    }



    public function updatePropertyFacilities(Request $request)
    {
        if ($request->facility_name == NULL) {
            return redirect()->back();
        } else {

            Facility::where('property_id', $request->property_id)->delete();
            $facilities = Count($request->facility_name);

            for ($i = 0; $i < $facilities; $i++) {
                $facility = new Facility();
                $facility->property_id = $request->property_id;
                $facility->facility_name = $request->facility_name[$i];
                $facility->distance = $request->distance[$i];
                $facility->save();
            }
        }


        $notification = array([
            "message" => "property Facilities have updated successfully",
            "alert-type" => "success",
        ]);

        return redirect()->back()->with($notification);
    }


    public function deleteProperty($id)
    {
        $property = Property::FindOrFail($id);
        unlink(public_path($property->property_thumbnail));
        $property->delete();
        $images = MultiImage::where('property_id', $id)->get();
        foreach ($images as $image) {
            unlink(public_path($image->photo_name));
            $image->delete();
        }

        $facilities = Facility::where('property_id', $id)->get();
        foreach ($facilities as $facility) {
            $facility->delete();
        }


        $notification = array([
            "message" => "property  have deleted successfully",
            "alert-type" => "success",
        ]);

        return redirect()->back()->with($notification);
    }



    public function showProperty($id)
    {
        $property = Property::findOrFail($id);
        $facilities = Facility::where('property_id', $id)->get();
        $property_aminities = explode(',', $property->aminities_id);
        $multiImages = MultiImage::where('property_id', $id)->get();
        $aminities = Aminity::latest()->get();
        $types = PropertyType::latest()->get();
        $activeAgents = User::where('status', 'active')->where('role', 'agent')->latest()->get();
        return view('backend.property.show_property', compact('property', 'facilities', 'property_aminities', 'aminities', 'types', 'activeAgents', 'multiImages'));
    }


    public function inactiveProperty($id)
    {
        $property = Property::findOrFail($id);
        $property->update([
            'status' => 0,
        ]);
        $notification = array([
            "message" => "property  have inactive successfully",
            "alert-type" => "success",
        ]);

        return redirect()->back()->with($notification);
    }

    public function activeProperty($id)
    {
        $property = Property::findOrFail($id);
        $property->update([
            'status' => 1,
        ]);
        $notification = array([
            "message" => "property  have inactive successfully",
            "alert-type" => "success",
        ]);

        return redirect()->back()->with($notification);
    }


    public function packageHistory()
    {
        $packages = PackagePlan::latest()->get();
        return view('backend.package.package_history',compact('packages'));
    }

    public function PackageInvoice($id){
        $packageHistory = PackagePlan::where('id',$id)->first();
        $pdf = Pdf::loadView('backend.package.package_history_invoice',compact('packageHistory'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    }



    public function adminPropertyMessage() {
        $id = Auth::user()->id;
        $adminMessages = PropertyMessage::where('agent_id',$id)->get();
        return view('admin.message.all_messages',compact('adminMessages'));
    }


    public function adminMessageDetails($id) {
        $ids = Auth::user()->id;
        $adminMessages = PropertyMessage::where('agent_id',$ids)->get();
        $messageDetails = PropertyMessage::findOrFail($id);

        return view('admin.message.messages_details',compact('adminMessages','messageDetails'));
    }
}
