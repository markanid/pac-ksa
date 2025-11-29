<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\MetaData;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class MetaDataController extends Controller
{
    public function index()
    {
        $meta_data = MetaData::latest('created_at')->first();
        if ($meta_data!=null) {
            $data['meta_data']  = $meta_data;
            $data['title']      = "Meta Data View";
            $data['page']       = "Meta Data";
            return view('admin.meta_data.view',$data);
        } else {
            return redirect()->route('meta_data.create');
        }       
    }

    public function createOrEdit($id = null)
    {
        $meta_data = $id ? MetaData::findOrFail($id) : new MetaData();
        $data['title'] = $id ? "Edit Meta Data" : "Create Meta Data";
        $data['meta_data'] = $meta_data;
        $data['page']   = "Meta Data";
        return view('admin.meta_data.create', $data);
    }

    public function storeOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:2000',
            'desciption'    => 'required|string|max:2000',
            'keyword'       => 'required|string|max:2000',
            'og_image'      => 'image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240'
        ]);

        $isNew  = empty($request->id);
        $meta_data = MetaData::find($request->id);

        if ($request->hasFile('og_image')) {
            if ($meta_data && $meta_data->og_image) {
                Storage::disk('public')->delete('meta_datas/' . $meta_data->og_image);
            }
            $image = $request->file('og_image');
            try {
                    $filename = time() . '_' . Str::random(8) . '.webp';
                    $path = storage_path('app/public/meta_datas/' . $filename);
                    Image::read($image)->toWebp(90)->save($path);
                } catch (\Exception $e) {
                    // WebP conversion failed, fallback to original format
                    $ext = $image->getClientOriginalExtension();
                    $filename = time() . '_' . Str::random(8) . '.' . $ext;
                    $path = storage_path('app/public/meta_datas/' . $filename);
            
                    // Save original format
                    Image::read($image)->save($path);
                }
                
            $validated['og_image'] = $filename; // Save filename to database
        }

        $meta_data = MetaData::updateOrCreate(
            ['id' => $request->id ?? null], 
            $validated
        );
        if ($meta_data) {
            return $isNew
                ? redirect()->route('meta_data.index')->with('success', 'Meta Data created successfully.')
                : redirect()->route('meta_data.index')->with('success', 'Meta Data details updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update meta data details.');
        }
    }

    public function show($id=null)
    {
        $meta_data = MetaData::latest('created_at')->first();
        $data['meta_data']  = $meta_data;
        $data['title']      = "Meta Data View";
        $data['page']       = "Meta Data";
        return view('admin.meta_data.view',$data);      
    }
    public function destroy($id=null)
    {
        $meta_data = MetaData::firstOrFail();
        if (!empty($meta_data->og_image) && Storage::disk('public')->exists('meta_datas/' . $meta_data->og_image)) {
            Storage::disk('public')->delete('meta_datas/' . $meta_data->og_image);
        }
        $meta_data->delete();
        return redirect()->route('meta_data.index')->with('success', 'Record deleted successfully');
    }
}
