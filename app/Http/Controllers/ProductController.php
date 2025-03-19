<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('admin.product.all', ['products' => $products]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.product.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:75'],
            'description' => ['required', 'string', 'min:3', 'max:150'],
            'content' => ['required', 'string', 'min:3', 'max:250'],
            'mrp' => ['required', 'decimal:2'],
            'price' => ['required', 'decimal:2'],
            'meta_title' => ['required', 'string', 'min:3', 'max:75'],
            'meta_desc' => ['required', 'string', 'min:3', 'max:150'],
            'meta_keyword' => ['required', 'string', 'min:3', 'max:100'],
            'category_id' => ['required', 'string'],
        ]);

        $product = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'mrp' => $request->mrp,
            'price' => $request->price,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,
            'meta_keyword' => $request->meta_keyword,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('admin.product.edit', ['id' => $product->id])->with('message', 'Product created successfully!');
    }

    public function edit(string $id)
    {
        $categories = Category::all();

        $product = Product::find($id);

        $productImages = ProductImage::where('product_id', $id)->get();

        $productAttributes = ProductAttribute::where('product_id', $id)->get();

        return view('admin.product.update', ['categories' => $categories, 'product' => $product, 'images' => $productImages, 'attributes' => $productAttributes]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:75'],
            'description' => ['required', 'string', 'min:3', 'max:150'],
            'content' => ['required', 'string', 'min:3', 'max:250'],
            'mrp' => ['required', 'decimal:2'],
            'price' => ['required', 'decimal:2'],
            'meta_title' => ['required', 'string', 'min:3', 'max:75'],
            'meta_desc' => ['required', 'string', 'min:3', 'max:150'],
            'meta_keyword' => ['required', 'string', 'min:3', 'max:100'],
            'status' => ['required', 'string'],
            'category_id' => ['required', 'string'],
        ]);

        $product = Product::find($id);

        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'mrp' => $request->mrp,
            'price' => $request->price,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,
            'meta_keyword' => $request->meta_keyword,
            'status' => $request->status,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('admin.product.edit', ['id' => $id])->with('message', 'Product updated successfully!');
    }

    public function add(Request $request, string $id)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $newName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            Storage::disk('public')->put($newName, file_get_contents($image));
        }

        ProductImage::create(['image' => $newName, 'product_id' => $id]);

        return redirect()->route('admin.product.update', ['id' => $id])->with('message', 'Product image added successfully!');
    }

    public function remove(Request $request, string $id, string $imageId)
    {
        $productImage = ProductImage::find($imageId);

        Storage::disk('public')->delete($productImage->image);

        $productImage->delete();

        return redirect()->route('admin.product.update', ['id' => $id])->with('message', 'Product image removed successfully!');
    }

    public function addAttribute(Request $request, string $id)
    {
        $request->validate([
            'size' => ['required', 'string', 'min:3', 'max:50'],
            'color' => ['required', 'string', 'min:3', 'max:50'],
            'mrp' => ['required', 'decimal:2'],
            'price' => ['required', 'decimal:2'],
        ]);

        ProductAttribute::create([
            'size' => $request->size,
            'color' => $request->color,
            'mrp' => $request->mrp,
            'price' => $request->price,
            'product_id' => $id
        ]);

        return redirect()->route('admin.product.update', ['id' => $id])->with('message', 'Product attribute added successfully!');
    }

    public function removeAttribute(Request $request, string $id, string $attributeId)
    {
        $productAttribute = ProductAttribute::find($attributeId);

        $productAttribute->delete();

        return redirect()->route('admin.product.update', ['id' => $id])->with('message', 'Product attribute removed successfully!');
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);

        $product->delete();

        return redirect()->route('admin.products')->with('message', 'Product deleted successfully!');
    }

    public function home(Request $request)
    {
        $banners = Banner::all()->where('status', 'active');

        $query = Product::with(['category', 'images'])->where('status', 'active');

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $products = $query->paginate(10);

        $categories = Category::all();

        return view('dashboard', ['banners' => $banners, 'categories' => $categories, 'products' => $products]);
    }

    public function show(string $id)
    {
        $product = Product::find($id);

        return view('product-details', ['product' => $product]);
    }
}