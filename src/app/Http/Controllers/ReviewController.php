<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Restaurant;
use App\Models\Reservation;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user', 'restaurant')->get(); // ユーザーと店舗情報を含めてレビューを取得
        return view('owner.reviews', compact('reviews'));
    }

    public function create($restaurantId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId);

        // ユーザーがその店舗を予約したことがあるかを確認
        $hasReservation = Reservation::where('user_id', auth()->id())
            ->where('restaurant_id', $restaurantId)
            ->where('status', 'completed')
            ->exists();

        if (!$hasReservation) {
            return redirect()->route('restaurants.show', $restaurantId)->with('error', 'この店舗を訪れたことがないため、レビューを書くことができません。');
        }

        return view('customer.review', compact('restaurant'));
    }

    public function store(ReviewRequest $request)
    {
        Review::create([
            'user_id' => auth()->id(),
            'restaurant_id' => $request->restaurant_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'review_date' => $request->review_date,
        ]);

        return redirect()->route('mypage.show')->with('success', 'レビューありがとうございます！');
    }
}
