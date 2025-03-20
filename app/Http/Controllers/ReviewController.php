<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::paginate(10);

        return view('admin.reviews', ['reviews' => $reviews]);
    }

    public function myReviews(Request $request)
    {
        $reviews = Review::all()->where('user_id', $request->user()->id);

        return view('reviews', ['reviews' => $reviews]);
    }

    public function store(Request $request, string $id)
    {
        $request->validate([
            'rating' => ['required', 'string', 'min:1', 'max:1'],
            'review' => ['required', 'string', 'min:3', 'max:150'],
        ]);

        if ($request->rating > 5 || $request->rating < 1) {
            return redirect()->route('product.details', ['id' => $id])->with('message', 'Rating should be between 1 to 5');
        }

        Review::create([
            'rating' => $request->rating,
            'review' => $request->review,
            'product_id' => $id,
            'user_id' => $request->user()->id
        ]);

        return redirect()->route('product.details', ['id' => $id])->with('message', 'Review created successfully!');
    }
}