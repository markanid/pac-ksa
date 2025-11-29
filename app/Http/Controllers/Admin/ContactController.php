<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::latest('created_at')->first();
        if ($contact) {
            $data['contact']    = $contact;
            $data['title']      = "Contact View";
            $data['page']       = "Contact";
            return view('admin.contact.view',$data);
        } else {
            return redirect()->route('contact.create');
        }       
    }

    public function createOrEdit($id = null)
    {
        $contact = $id ? Contact::findOrFail($id) : new Contact();
        $data['title'] = $id ? "Edit Contact" : "Create Contact";
        $data['contact'] = $contact;
        $data['page']   = "Contact";
        return view('admin.contact.create', $data);
    }

    public function storeOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'addresses'     => 'nullable|array',
            'addresses.*'   => 'nullable|string|max:1000',
            'address_images'  => 'nullable|array',
            'address_images.*'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'phones'    => 'required|array',
            'locations' => 'nullable|string|max:1000',
            'email'     => 'required|string|max:500',
            'facebook'  => 'nullable|string|max:500',
            'instagram' => 'nullable|string|max:500',
            'linkedin'  => 'nullable|string|max:500',
            'x'         => 'nullable|string|max:500',
        ]);

        $isNew  = empty($request->id);

        // If editing, get existing contact to fetch old addresses
        $existingContact = $isNew ? null : Contact::find($request->id);
        $oldAddresses = [];

        if ($existingContact && $existingContact->addresses) {
            $oldAddresses = json_decode($existingContact->addresses, true) ?: [];
        }

        $combinedAddresses = [];
        $addressTexts = $validated['addresses'] ?? [];
        $images = $request->file('address_images', []);

        foreach ($addressTexts as $index => $addrText) {
            $imagePath = null;
            // Extract title from the address for image name
            $parts = explode(',', $addrText, 2);
            $title = trim($parts[0]); 
            $slugTitle = Str::slug($title); 

            if (isset($images[$index]) && $images[$index]->isValid()) {
                 // If old image exists for this address, delete it
                if (isset($oldAddresses[$index]['image']) && $oldAddresses[$index]['image']) {
                    Storage::disk('public')->delete($oldAddresses[$index]['image']);
                }
                // Build custom file name
                $extension = $images[$index]->getClientOriginalExtension();
                $fileName = $slugTitle . '-' . uniqid() . '.' . $extension;
                // Store new image
                $imagePath = $images[$index]->storeAs('address_images', $fileName, 'public');
            } else {
                // No new image uploaded, keep old image path if exists
                $imagePath = $oldAddresses[$index]['image'] ?? null;
            }

            $combinedAddresses[] = [
                'address' => $addrText,
                'image'   => $imagePath,
            ];
        }

        $data = array_merge($validated, [
            'phones'    => json_encode($validated['phones']),
            'addresses' => json_encode($combinedAddresses),
        ]);

        $contact = Contact::updateOrCreate(
            ['id' => $request->id],
            $data
        );

        if ($contact) {
            return redirect()->route('contact.show', $contact->id)
                ->with('success', $isNew ? 'Contact created successfully.' : 'Contact updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update contact details.');
        }
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        $data['contact']    = $contact;
        $data['title']      = "Contact View";
        $data['page']       = "Contact";
        return view('admin.contact.view',$data);      
    }
    public function destroy($id=null)
    {
        // Find the model instance by ID
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('contact.index')->with('success', 'Record deleted successfully');
    }
}
