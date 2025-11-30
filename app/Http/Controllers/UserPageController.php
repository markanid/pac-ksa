<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\Admin\About;
use App\Models\Admin\Category;
use App\Models\Admin\Client;
use App\Models\Admin\Contact;
use App\Models\Admin\Project;
use App\Models\Admin\Service;
use App\Models\Admin\Sliders;
use Carbon\Carbon;
use App\Models\HomeModel;
 
use App\Models\Applicant;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class UserPageController extends Controller
{
    public function home() {

        $data = [
                'clients'       => Client::oldest('created_at')->get(),
                'get_sliders'   => Sliders::oldest('created_at')->get(),
                ];
        return view("users.home",$data);
    }

    public function home_ar() {
        $data = [
                'clients'       => Client::oldest('created_at')->get(),
                'get_sliders'   => Sliders::oldest('created_at')->get(),
            ];
        return view("users_ar.home", $data);
    }

    public function about() {
        return view("users.about");
    }

    public function about_ar() {
        return view("users_ar.about");
    }

    public function contact() {
        return view("users.contact");
    }

    public function contact_ar() {
        return view("users_ar.contact");
    }

    public function service() {
        return view("users.service");
    }

    public function service_ar() {
        return view("users_ar.service");
    }
   
    public function servicedetails($slug) {
        return view("users.servicedetails", [
            'service'   => Service::where('slug', $slug)->firstOrFail(),
        ]);
    }
   
    public function servicedetails_ar($slug) {
        return view("users_ar.servicedetails", [
            'service'   => Service::where('slug', $slug)->firstOrFail(),
        ]);
    }

    public function projects() {
        return view("users.projects",[
            'projects'      => Project::oldest('created_at')->get(),
        ]);
    }

    public function projects_ar() {
        return view("users_ar.projects",[
            'projects'       => Project::oldest('created_at')->get(),
        ]);
    }

     public function sendEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|string|email|max:100',
            'message' => 'nullable|string|max:1000',
            'subject' => 'nullable|string|max:255',
            'phone'   => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            Mail::to('info@apexsoftlabs.com')->send(new ContactFormMail($request->all()));
            return redirect()->back()->with('success_message', 'Your message has been sent successfully.');
        } catch (\Exception $e) {
            Log::error('Mail Send Error: ' . $e->getMessage());
            return redirect()->back()->with('error_message', 'Sorry there was an error sending your form.');
        }
    }

}
