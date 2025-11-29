<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Validation\ValidationException;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::oldest('created_at')->get();
        $data = [
            'projects' => $projects,
            'title'    => 'Portfolio List',
            'page'     => 'Portfolio'
        ];
        return view('admin.projects.index', $data);   
    }

    public function createOrEdit($id = null)
    {
        $project = $id ? Project::with('category')->findOrFail($id): new Project();
        $categories         = Category::all();
        $data['title']      = $id ? "Edit Portfolio" : "Create Portfolio";
        $data['categories'] = $categories;
        $data['project']    = $project;
        $data['page']       = "Portfolio";
        return view('admin.projects.create', $data);
    }

    public function storeOrUpdate(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'          => 'required|string|max:100',
                'category_id'   => 'required|integer',
                'date'          => 'required|date_format:d/m/Y',
                'country'       => 'required|string|max:100',
                'industry'      => 'required|string|max:100',
                'website'       => 'required|string|max:100',
                'keyword'       => 'nullable|string',
                'desktop_image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240', // 10MB
                'mobile_image'  => 'image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240', // 10MB
                'image_alt_tag' => 'nullable|string|max:255',
                'meta_title'    => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:500',
            ]);
        } catch (ValidationException $e) {
            dd($e->errors());
        }

        $validated['date'] = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');

        $isNew      = empty($request->id);
        $project    = $isNew ? new Project() : Project::findOrFail($request->id);

        if ($request->hasFile('desktop_image')) {
            if (!$isNew && $project->desktop_image) {
                Storage::disk('public')->delete('projects/' . $project->desktop_image);
            }
            $desktop_image = $request->file('desktop_image');
            try {
                    $filename = time() . '_' . Str::random(8) . '.webp';
                    $path = storage_path('app/public/projects/' . $filename);
                    Image::read($desktop_image)->toWebp(90)->save($path);
                } catch (\Exception $e) {
                    // WebP conversion failed, fallback to original format
                    $ext = $desktop_image->getClientOriginalExtension();
                    $filename = time() . '_' . Str::random(8) . '.' . $ext;
                    $path = storage_path('app/public/projects/' . $filename);
            
                    // Save original format
                    Image::read($desktop_image)->save($path);
                }
            $validated['desktop_image'] = $filename; // Save filename to database
        }

        if ($request->hasFile('mobile_image')) {
            if (!$isNew && $project->mobile_image) {
                Storage::disk('public')->delete('projects/mobile/' . $project->mobile_image);
            }
            $mobile_image = $request->file('mobile_image');
            try {
                    $filename = time() . '_' . Str::random(8) . '.webp';
                    $path = storage_path('app/public/projects/mobile/' . $filename);
                    Image::read($mobile_image)->toWebp(90)->save($path);
                } catch (\Exception $e) {
                    // WebP conversion failed, fallback to original format
                    $ext = $mobile_image->getClientOriginalExtension();
                    $filename = time() . '_' . Str::random(8) . '.' . $ext;
                    $path = storage_path('app/public/projects/mobile/' . $filename);
            
                    // Save original format
                    Image::read($mobile_image)->save($path);
                }
            $validated['mobile_image'] = $filename; // Save filename to database
        }
        $validated['slug'] = Str::slug($request->name, '-');

        $project = Project::updateOrCreate(
            ['id' => $request->id ?? null], 
            $validated
        );

        return redirect()->route('projects.index')->with(
            $isNew ? 'success' : 'success',
            $isNew ? 'Portfolio created successfully.' : 'Portfolio details updated successfully.'
        );
    }

    public function show($slug=null)
    {
        $project = Project::with('category')->where('slug', $slug)->firstOrFail();
        $data['project']    = $project;
        $data['title']      = "Portfolio View";
        $data['page']       = "Portfolio";
        return view('admin.projects.view',$data);      
    }


    
 public function updateFeatured(Request $request)
{
    $service = Project::find($request->id);

    if ($service) {
        $service->featured = $request->featured;
        $service->save();

        return response()->json(['message' => 'Updated successfully']);
    }

    return response()->json(['message' => 'Service not found'], 404);
}
    
    public function destroy($id=null)
    {
        $project = Project::findOrFail($id);
        if (!empty($project->desktop_image) && Storage::disk('public')->exists('projects/' . $project->desktop_image)) {
            Storage::disk('public')->delete('projects/' . $project->desktop_image);
        }
        if (!empty($project->mobile_image) && Storage::disk('public')->exists('projects/mobile/' . $project->mobile_image)) {
            Storage::disk('public')->delete('projects/mobile/' . $project->mobile_image);
        }
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Record deleted successfully');
    }
}
