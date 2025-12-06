<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Sliders;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class SlidersController extends Controller
{
     

     public function index()
    {
        $sliders = Sliders::oldest('created_at')->get();
        $data = [
            'sliders' => $sliders,
            'title' => 'Sliders List',
            'page'  => 'Sliders'
        ];
        return view('admin.sliders.index',$data);     
    }

    public function createOrEdit($id = null)
    {
        $sliders = $id ? Sliders::findOrFail($id) : new Sliders();
        $data['title'] = $id ? "Edit Sliders" : "Create Sliders";
        $data['sliders'] = $sliders;
        $data['page']   = "Sliders";
        return view('admin.sliders.create', $data);
    }

    public function storeOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'heading_1'     => 'string',
            'heading_2'     => 'string',
            'title'         => 'string',
            'heading_1ar'   => 'string',
            'heading_2ar'   => 'string',
            'title_ar'      => 'string',
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240'
        ]);

        $isNew  = empty($request->id);
        $sliders = Sliders::find($request->id);

        if ($request->hasFile('image')) {
            if ($sliders && $sliders->image) {
                Storage::disk('public')->delete('sliders/' . $sliders->image);
            }
            $image = $request->file('image');
            try {
                    $filename = time() . '_' . Str::random(8) . '.webp';
                    $path = storage_path('app/public/sliders/' . $filename);
                    Image::read($image)->toWebp(90)->save($path);
                } catch (\Exception $e) {
                    // WebP conversion failed, fallback to original format
                    $ext = $image->getClientOriginalExtension();
                    $filename = time() . '_' . Str::random(8) . '.' . $ext;
                    $path = storage_path('app/public/sliders/' . $filename);
            
                    // Save original format
                    Image::read($image)->save($path);
                }
            $validated['image'] = $filename; // Save filename to database
        }

        $sliders = Sliders::updateOrCreate(
            ['id' => $request->id ?? null], 
            $validated
        );
        if ($sliders) {
            return $isNew
                ? redirect()->route('sliders.index')->with('success', 'Sliders created successfully.')
                : redirect()->route('sliders.index')->with('success', 'Sliders details updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update sliders details.');
        }
    }

    public function show($id=null)
    {
        $data['slider'] = Sliders::where('id', $id)->firstOrFail();
        $data['title']  = "Sliders View";
        $data['page']   = "Sliders";
        return view('admin.sliders.view',$data);      
    }
    public function destroy($id=null)
    {
        $sliders = Sliders::firstOrFail();
        if (!empty($sliders->image) && Storage::disk('public')->exists('sliders/' . $sliders->image)) {
            Storage::disk('public')->delete('sliders/' . $sliders->image);
        }
        $sliders->delete();
        return redirect()->route('sliders.index')->with('success', 'Record deleted successfully');
    }
}
