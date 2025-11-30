<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::oldest('created_at')->get();
        if ($clients!=null && !$clients->isEmpty()) { 
            $data['clients']    = $clients;
            $data['title']      = "Client List";
            $data['page']       = "Client";
            return view('admin.clients.index',$data);
        } else {
            return redirect()->route('clients.create');
        }       
    }

    public function createOrEdit($id = null)
    {
        $client = $id ? Client::findOrFail($id) : new Client();
        $data['title']  = $id ? "Edit Client" : "Create Client";
        $data['client'] = $client;
        $data['page']   = "Client";
        return view('admin.clients.create', $data);
    }

    public function storeOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:500',
            'name_ar'       => 'required|string|max:500',
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240'
        ]);

        $isNew  = empty($request->id);
        $client = Client::find($request->id);

        if ($request->hasFile('image')) {
            if ($client && $client->image) {
                Storage::disk('public')->delete('clients/' . $client->image);
            }
            $image = $request->file('image');
            try {
                    $filename = time() . '_' . Str::random(8) . '.webp';
                    $path = storage_path('app/public/clients/' . $filename);
                    Image::read($image)->toWebp(90)->save($path);
                } catch (\Exception $e) {
                    // WebP conversion failed, fallback to original format
                    $ext = $image->getClientOriginalExtension();
                    $filename = time() . '_' . Str::random(8) . '.' . $ext;
                    $path = storage_path('app/public/clients/' . $filename);
            
                    // Save original format
                    Image::read($image)->save($path);
                }
            $validated['image'] = $filename; 
        }

        $slug = Str::slug($request->name, '-');
        $validated['slug']  = $slug;

        $client = Client::updateOrCreate(
            ['id' => $request->id ?? null], 
            $validated
        );
        if ($client) {
            return $isNew
                ? redirect()->route('clients.index')->with('success', 'Client created successfully.')
                : redirect()->route('clients.index')->with('success', 'Client details updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update client details.');
        }
    }

    public function show($slug=null)
    {
        $client = Client::where('slug', $slug)->firstOrFail();
        $data['client'] = $client;
        $data['title']  = "Client View";
        $data['page']   = "Client";
        return view('admin.clients.view',$data);      
    }
    public function destroy($id=null)
    {
        $client = Client::findOrFail($id);
        if (!empty($client->image) && Storage::disk('public')->exists('clients/' . $client->image)) {
            Storage::disk('public')->delete('clients/' . $client->image);
        }
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Record deleted successfully');
    }
}
