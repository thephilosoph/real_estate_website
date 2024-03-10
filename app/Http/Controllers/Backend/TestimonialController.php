<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
{
        public function allTestimonial() {
        $testimonials = Testimonial::latest()->get();
        return view('backend.testimonial.all_testimonial',compact('testimonials'));
        }


    public function addTestimonial(){

        return view('backend.testimonial.add_testimonial');
    }

    public function storeTestimonial(Request $request)
    {
        $image = $request->file('photo');
        $generatedName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(100, 100)->save(public_path('/uploade/testimonial/' . $generatedName));
        $url = '/uploade/testimonial/' . $generatedName;

        if(Testimonial::insert([
            'name'=>$request->name,
            'position'=>$request->position,
            'message'=>$request->message,
            'image'=>$url
        ])){

            $notification = array([
                "message"=>"testimonial have created successfully",
                "alert-type"=>"success",
            ]);

            return redirect()->route('all.testimonial')->with($notification);
        }

        $notification = array([
            "message"=>"testimonial haven't been created",
            "alert-type"=>"danger",
        ]);

        return redirect()->route('all.testimonial')->with($notification);
    }


    public function editTestimonial($id){
        $testimonial = Testimonial::findOrFail($id);
        return view('backend.testimonial.edit_testimonial',compact('testimonial'));
    }


    public function updateTestimonial(Request $request){
        $id = $request->id;

        if ($image = $request->file('photo')) {
            $generatedName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(100, 100)->save(public_path('/uploade/testimonial/' . $generatedName));
            $url = '/uploade/testimonial/' . $generatedName;

            if(Testimonial::findOrFail($id)->update([
                'name'=>$request->name,
                'position'=>$request->position,
                'message'=>$request->message,
                'image'=>$url
            ])) {
                $notification = array([
                    "message"=>"testimonial have updated successfully",
                    "alert-type"=>"success",
                ]);

                return redirect()->route('all.testimonial')->with($notification);
            }
        }
        Testimonial::findOrFail($id)->update([
            'name'=>$request->name,
            'position'=>$request->position,
            'message'=>$request->message,
        ]);
        $notification = array([
            "message"=>"testimonial have updated successfully",
            "alert-type"=>"success",
        ]);
        return redirect()->route('all.testimonial')->with($notification);

    }

    public function deleteTestimonial($id){


        $testimonial = Testimonial::findOrFail($id);

        $img = '.'.$testimonial->image;
//        dd ($img)   ;
        unlink($img);
        $testimonial->delete();

        $notification = array([
            "message"=>"testimonial have deleted successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->back()->with($notification);
    }





}
