<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::oldest('created_at')->get();
        $data = [
            'blogs' => $blogs,
            'title' => 'Blogs List',
            'page'  => 'Blogs'
        ];
        return view('admin.blogs.index',$data);     
    }

    public function createOrEdit($id = null)
    {
        $blog = $id ? Blog::findOrFail($id) : new Blog();
        $data['title']      = $id ? "Edit Blog" : "Create Blog";
        $data['blog']  = $blog;
        $data['page']       = "News & Events";
        return view('admin.blogs.create', $data);
    }

    public function storeOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'date'      => 'required|date_format:d/m/Y',
            'heading'   => 'required|string|max:500',
            'details'   => 'required|string',
            'keyword'   => 'nullable|string|max:1000',
            'image'     => 'image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240'
        ]);

        $validated['date'] = Carbon::createFromFormat('d/m/Y', $validated['date'])->format('Y-m-d');

        $isNew  = empty($request->id);
        $blog   = Blog::find($request->id);

        if ($request->hasFile('image')) {
            if ($blog && $blog->image) {
                Storage::disk('public')->delete('blogs/' . $blog->image);
            }
            $image = $request->file('image');
            try {
                    $filename = time() . '_' . Str::random(8) . '.webp';
                    $path = storage_path('app/public/blogs/' . $filename);
                    Image::read($image)->toWebp(90)->save($path);
                } catch (\Exception $e) {
                    // WebP conversion failed, fallback to original format
                    $ext = $image->getClientOriginalExtension();
                    $filename = time() . '_' . Str::random(8) . '.' . $ext;
                    $path = storage_path('app/public/blogs/' . $filename);
            
                    // Save original format
                    Image::read($image)->save($path);
                }
            $validated['image'] = $filename; // Save filename to database
        }

        $slug = Str::slug($request->heading, '-');
        $validated['slug']  = $slug;

        $blog = Blog::updateOrCreate(
            ['id' => $request->id ?? null], 
            $validated
        );

        return redirect()->route('blogs.index')->with(
            $isNew ? 'success' : 'success',
            $isNew ? 'Blog created successfully.' : 'Blog details updated successfully.'
        );
    }

    public function show($slug=null)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $data['blog']   = $blog;
        $data['title']  = "Blog View";
        $data['page']   = "Blog";
        return view('admin.blogs.view',$data);      
    }
    public function destroy($id=null)
    {
        $blog = Blog::findOrFail($id);
        if (!empty($blog->image) && Storage::disk('public')->exists('blogs/' . $blog->image)) {
            Storage::disk('public')->delete('blogs/' . $blog->image);
        }
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Record deleted successfully');
    }
}
