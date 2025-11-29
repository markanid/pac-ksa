<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::oldest('created_at')->get();
        if ($teams!=null && !$teams->isEmpty()) { 
            $data['teams']  = $teams;
            $data['title']  = "Team List";
            $data['page']   = "Team";
            return view('admin.teams.index',$data);
        } else {
            return redirect()->route('teams.create');
        }       
    }

    public function createOrEdit($id = null)
    {
        $team = $id ? Team::findOrFail($id) : new Team();
        $data['title']  = $id ? "Edit Team" : "Create Team";
        $data['team']   = $team;
        $data['page']   = "Team";
        return view('admin.teams.create', $data);
    }

    public function storeOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:500',
            'designation'   => 'required|string|max:500',
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240'
        ]);

        $isNew  = empty($request->id);
        $team   = Team::find($request->id);

        if ($request->hasFile('image')) {
            if ($team && $team->image) {
                Storage::disk('public')->delete('teams/' . $team->image);
            }
            $image = $request->file('image');
            try {
                    $filename = time() . '_' . Str::random(8) . '.webp';
                    $path = storage_path('app/public/teams/' . $filename);
                    Image::read($image)->toWebp(90)->save($path);
                } catch (\Exception $e) {
                    // WebP conversion failed, fallback to original format
                    $ext = $image->getClientOriginalExtension();
                    $filename = time() . '_' . Str::random(8) . '.' . $ext;
                    $path = storage_path('app/public/teams/' . $filename);
            
                    // Save original format
                    Image::read($image)->save($path);
                }
            $validated['image'] = $filename; 
        }

        $slug = Str::slug($request->name, '-');
        $validated['slug']  = $slug;

        $team = Team::updateOrCreate(
            ['id' => $request->id ?? null], 
            $validated
        );
        if ($team) {
            return $isNew
                ? redirect()->route('teams.index')->with('success', 'Team created successfully.')
                : redirect()->route('teams.index')->with('success', 'Team details updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update team details.');
        }
    }

    public function show($slug=null)
    {
        $team = Team::where('slug', $slug)->firstOrFail();
        $data['team']   = $team;
        $data['title']  = "Team View";
        $data['page']   = "Team";
        return view('admin.teams.view',$data);      
    }
    public function destroy($id=null)
    {
        $team = Team::findOrFail($id);
        if (!empty($team->image) && Storage::disk('public')->exists('teams/' . $team->image)) {
            Storage::disk('public')->delete('teams/' . $team->image);
        }
        $team->delete();
        return redirect()->route('teams.index')->with('success', 'Record deleted successfully');
    }
}
