<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.category.all', ['categories' => $categories]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'lowercase', 'min:3', 'unique:' . Category::class],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $newName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            Storage::disk('public')->put($newName, file_get_contents($image));
        }

        Category::create(['name' => $request->name, 'image' => $newName]);

        return redirect()->route('admin.categories')->with('message', 'Category created successfully!');
    }

    public function edit(string $id)
    {
        $category = Category::find($id);

        return view('admin.category.update', ['category' => $category]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'lowercase', 'min:3', 'unique:' . Category::class],
            'status' => ['required', 'string']
        ]);

        $category = Category::find($id);

        $category->update(['name' => $request->name, 'status' => $request->status]);

        return redirect()->route('admin.category.edit', ['id' => $id])->with('message', 'Category updated successfully!');
    }

    public function image(Request $request, string $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $category = Category::find($id);

        if (isset($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        if ($request->file('image')) {
            $image = $request->file('image');
            $newName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            Storage::disk('public')->put($newName, file_get_contents($image));
        }

        $category->update(['image' => $newName]);

        return redirect()->route('admin.category.edit', ['id' => $id])->with('message', 'Category image updated successfully!');
    }

    public function destroy(string $id)
    {
        $category = Category::find($id);

        Storage::disk('public')->delete($category->image);

        $category->delete();

        return redirect()->route('admin.categories')->with('message', 'Category deleted successfully!');
    }
}