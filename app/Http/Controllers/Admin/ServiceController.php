<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::oldest('created_at')->get();
        if ($services!=null && !$services->isEmpty()) { 
            $data['services']   = $services;
            $data['title']      = "Service List";
            $data['page']       = "Service";
            return view('admin.services.index',$data);
        } else {
            return redirect()->route('services.create');
        }       
    }

    public function createOrEdit($id = null)
    {
        $service = $id ? Service::findOrFail($id) : new Service();
        $data['title'] = $id ? "Edit Service" : "Create Service";
        $data['service'] = $service;
        $data['page']   = "Service";
        return view('admin.services.create', $data);
    }

    public function storeOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:500',
            'details'       => 'nullable|string',
            'meta_title'       => 'nullable|string',
            'description'   => 'nullable|string|max:2000',
            'keyword'       => 'nullable|string|max:1000',
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
            'image_alt_tag' => 'required|string|max:100'
        ]);

        $isNew      = empty($request->id);
        $service    = Service::find($request->id);

        if ($request->hasFile('image')) {
            if ($service && $service->image) {
                Storage::disk('public')->delete('services/' . $service->image);
            }
            $image = $request->file('image');
            try {
                    $filename = time() . '_' . Str::random(8) . '.webp';
                    $path = storage_path('app/public/services/' . $filename);
                    Image::read($image)->toWebp(90)->save($path);
                } catch (\Exception $e) {
                    // WebP conversion failed, fallback to original format
                    $ext = $image->getClientOriginalExtension();
                    $filename = time() . '_' . Str::random(8) . '.' . $ext;
                    $path = storage_path('app/public/services/' . $filename);
            
                    // Save original format
                    Image::read($image)->save($path);
                }
            $validated['image'] = $filename; // Save filename to database
        }

        $slug = Str::slug($request->name, '-');
        $validated['slug']  = $slug;

        $service = Service::updateOrCreate(
            ['id' => $request->id ?? null], 
            $validated
        );
        if ($service) {
            return $isNew
                ? redirect()->route('services.index')->with('success', 'Service created successfully.')
                : redirect()->route('services.index')->with('success', 'Service details updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update service details.');
        }
    }

    public function show($slug=null)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        // $service = Service::findOrFail($id);
        $data['service']    = $service;
        $data['title']      = "Service View";
        $data['page']       = "Service";
        return view('admin.services.view',$data);      
    }
    public function destroy($id=null)
    {
        $service = Service::findOrFail($id);
        if (!empty($service->image) && Storage::disk('public')->exists('services/' . $service->image)) {
            Storage::disk('public')->delete('services/' . $service->image);
        }
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Record deleted successfully');
    }


 public function updateFeatured(Request $request)
{
    $service = Service::find($request->id);

    if ($service) {
        $service->featured = $request->featured;
        $service->save();

        return response()->json(['message' => 'Updated successfully']);
    }

    return response()->json(['message' => 'Service not found'], 404);
}


}
