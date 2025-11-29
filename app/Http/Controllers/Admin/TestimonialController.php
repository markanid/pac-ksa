<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::oldest('created_at')->get();
        if ($testimonials!=null && !$testimonials->isEmpty()) { 
            $data['testimonials']   = $testimonials;
            $data['title']      = "Testimonial List";
            $data['page']       = "Testimonial";
            return view('admin.testimonials.index',$data);
        } else {
            return redirect()->route('testimonials.create');
        }       
    }

    public function createOrEdit($id = null)
    {
        $testimonial = $id ? Testimonial::findOrFail($id) : new Testimonial();
        $data['title']          = $id ? "Edit Testimonial" : "Create Testimonial";
        $data['testimonial']    = $testimonial;
        $data['page']           = "Testimonial";
        return view('admin.testimonials.create', $data);
    }

    public function storeOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'client_name'   => 'required|string|max:500',
            'position'      => 'required|string|max:500',
            'company'       => 'required|string|max:500',
            'message'       => 'required|string',
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240'
        ]);

        $isNew      = empty($request->id);
        $testimonial    = Testimonial::find($request->id);

        if ($request->hasFile('image')) {
            if ($testimonial && $testimonial->image) {
                Storage::disk('public')->delete('testimonials/' . $testimonial->image);
            }
            $image = $request->file('image');
            try {
                    $filename = time() . '_' . Str::random(8) . '.webp';
                    $path = storage_path('app/public/testimonials/' . $filename);
                    Image::read($image)->toWebp(90)->save($path);
                } catch (\Exception $e) {
                    // WebP conversion failed, fallback to original format
                    $ext = $image->getClientOriginalExtension();
                    $filename = time() . '_' . Str::random(8) . '.' . $ext;
                    $path = storage_path('app/public/testimonials/' . $filename);
            
                    // Save original format
                    Image::read($image)->save($path);
                }
            $validated['image'] = $filename; // Save filename to database
        }

        $slug = Str::slug($request->company, '-');
        $validated['slug']  = $slug;

        $testimonial = Testimonial::updateOrCreate(
            ['id' => $request->id ?? null], 
            $validated
        );
        if ($testimonial) {
            return $isNew
                ? redirect()->route('testimonials.index')->with('success', 'Testimonial created successfully.')
                : redirect()->route('testimonials.index')->with('success', 'Testimonial details updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update testimonial details.');
        }
    }

    public function show($slug=null)
    {
        $testimonial = Testimonial::where('slug', $slug)->firstOrFail();
        $data['testimonial']    = $testimonial;
        $data['title']          = "Testimonial View";
        $data['page']           = "Testimonial";
        return view('admin.testimonials.view',$data);      
    }
    
    public function destroy($id=null)
    {
        $testimonial = Testimonial::findOrFail($id);
        if (!empty($testimonial->image) && Storage::disk('public')->exists('testimonials/' . $testimonial->image)) {
            Storage::disk('public')->delete('testimonials/' . $testimonial->image);
        }
        $testimonial->delete();
        return redirect()->route('testimonials.index')->with('success', 'Record deleted successfully');
    }
}
