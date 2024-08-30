<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create()
    {
        return view('customer.review');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'review_date' => 'required|date',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'restaurant_id' => $request->restaurant_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'review_date' => $request->review_date,
        ]);

        return redirect()->route('customer.review')->with('success', 'レビューが作成されました！');
    }
}
