<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();

        return view('admin.banner.all', ['banners' => $banners]);
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading1' => ['required', 'string', 'lowercase', 'min:3', 'max:100'],
            'heading2' => ['required', 'string', 'lowercase', 'min:3', 'max:100'],
            'btn_link' => ['required', 'string', 'lowercase', 'min:3', 'max:100'],
            'btn_txt' => ['required', 'string', 'lowercase', 'min:3', 'max:100'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $newName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            Storage::disk('public')->put($newName, file_get_contents($image));
        }

        Banner::create([
            'heading1' => $request->heading1,
            'heading2' => $request->heading2,
            'btn_link' => $request->btn_link,
            'btn_txt' => $request->btn_txt,
            'image' => $newName
        ]);

        return redirect()->route('admin.banners')->with('message', 'Banner created successfully!');
    }

    public function edit(string $id)
    {
        $banner = Banner::find($id);

        return view('admin.banner.update', ['banner' => $banner]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'heading1' => ['required', 'string', 'lowercase', 'min:3', 'max:100'],
            'heading2' => ['required', 'string', 'lowercase', 'min:3', 'max:100'],
            'btn_link' => ['required', 'string', 'lowercase', 'min:3', 'max:100'],
            'btn_txt' => ['required', 'string', 'lowercase', 'min:3', 'max:100'],
            'status' => ['required', 'string']
        ]);

        $banner = Banner::find($id);

        $banner->update([
            'heading1' => $request->heading1,
            'heading2' => $request->heading2,
            'btn_link' => $request->btn_link,
            'btn_txt' => $request->btn_txt,
            'status' => $request->status
        ]);

        return redirect()->route('admin.banner.edit', ['id' => $id])->with('message', 'Banner updated successfully!');
    }

    public function image(Request $request, string $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $banner = Banner::find($id);

        if (isset($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }

        if ($request->file('image')) {
            $image = $request->file('image');
            $newName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            Storage::disk('public')->put($newName, file_get_contents($image));
        }

        $banner->update(['image' => $newName]);

        return redirect()->route('admin.banner.edit', ['id' => $id])->with('message', 'Banner image updated successfully!');
    }

    public function destroy(string $id)
    {
        $banner = Banner::find($id);

        Storage::disk('public')->delete($banner->image);

        $banner->delete();

        return redirect()->route('admin.banners')->with('message', 'Banner deleted successfully!');
    }
}