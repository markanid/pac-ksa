<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::oldest('created_at')->get();
        if ($categories!=null && !$categories->isEmpty()) { 
            $data['categories'] = $categories;
            $data['title']      = "Category List";
            $data['page']       = "Category";
            return view('admin.categories.index',$data);
        } else {
            return redirect()->route('categories.create');
        }       
    }

    public function createOrEdit($id = null)
    {
        $category = $id ? Category::findOrFail($id) : new Category();
        $data['title']      = $id ? "Edit Category" : "Create Category";
        $data['category']   = $category;
        $data['page']       = "Category";
        return view('admin.categories.create', $data);
    }

    public function storeOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:500'
        ]);

        $isNew      = empty($request->id);
        $category    = Category::find($request->id);

        $category = Category::updateOrCreate(
            ['id' => $request->id ?? null], 
            $validated
        );
        if ($category) {
            return $isNew
                ? redirect()->route('categories.index')->with('success', 'Category created successfully.')
                : redirect()->route('categories.index')->with('success', 'Category details updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update category details.');
        }
    }

    public function destroy($id=null)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Record deleted successfully');
    }
}
