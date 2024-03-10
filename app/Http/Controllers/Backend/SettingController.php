<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function smtpSetting()
    {
     $setting = SmtpSetting::find(1);
     return view('backend.setting.smtp_update',compact('setting'));
    }

    public function updateSmtpSetting(Request $request)
    {
        SmtpSetting::find(1)->update([
            'mailer'=>$request->mailer,
            'host'=>$request->host,
            'post'=>$request->post,
            'username'=>$request->username,
            'password'=>$request->password,
            'encryption'=>$request->encryption,
            'from_address'=>$request->from_address,
        ]);

        $notification = array([
            "message" => "SMTP Setting have updated successfully",
            "alert-type" => "success",
        ]);

        return redirect()->back()->with($notification);
    }



    public function siteSetting()
    {
        $setting = SiteSetting::find(1);
        return view('backend.setting.site_update',compact('setting'));
    }




    public function updateSiteSetting(Request $request)
    {
        if ($image = $request->file('logo')) {
            $generatedName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1500, 386)->save(public_path('/uploade/logo/' . $generatedName));
            $url = '/uploade/logo/' . $generatedName;
            SiteSetting::find(1)->update([
                'logo' => $url,
                'support_phone' => $request->support_phone,
                'company_address' => $request->company_address,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'copyright' => $request->copyright,
            ]);
        }else{
            SiteSetting::find(1)->update([
                'support_phone' => $request->support_phone,
                'company_address' => $request->company_address,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'copyright' => $request->copyright,
            ]);
        }
        $notification = array([
            "message" => "Site Setting have updated successfully",
            "alert-type" => "success",
        ]);
        return redirect()->back()->with($notification);
    }
}
