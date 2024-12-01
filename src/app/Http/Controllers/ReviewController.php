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
        return view('admin.reviews', compact('reviews'));
    }

    public function create($restaurantId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId);
        $userId = auth()->id();
        // 重複レビューのチェック
        $existingReview = Review::where('user_id', $userId)
            ->where('restaurant_id', $restaurantId)
            ->first();

        if ($existingReview) {
            return redirect()->route('restaurants.show', $restaurantId)->with('error', 'この店舗には既にレビューを投稿しています。');
        }

        return view('customer.review', compact('restaurant'));
    }

    public function store(ReviewRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->id();
        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('reviews', 'public');
        }
        Review::create($data);
        return redirect()->route('mypage.show')->with('success', 'レビューありがとうございます！');
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        $restaurantId = $review->restaurant_id;

        if ($review->user_id !== auth()->id()) {
            return redirect()->route('restaurants.show', $restaurantId)->with('error', 'このレビューを編集する権限がありません。');
        }

        return view('customer.review_edit', compact('review'));
    }

    public function update(ReviewRequest $request, $id)
    {
        $review = Review::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            // 古い画像を削除
            if ($review->image_url) {
                // Storage::disk('public')->delete($review->image_url);
            }
            $data['image_url'] = $request->file('image')->store('reviews', 'public');
        }

        $review->update($data);

        return redirect()->route('mypage.show')->with('success', 'レビューを更新しました！');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id); // ユーザーまたは管理者のみ削除可能
        $restaurantId = $review->restaurant_id;
        if (auth()->id() === $review->user_id || auth()->user()->is_admin) { // 画像を削除
            if ($review->image_url) {
                // Storage::disk('public')->delete($review->image_url);
            }
            $review->delete();
            return redirect()->route('restaurants.show', $restaurantId)->with('success', 'レビューを削除しました。');
        }
        return redirect()->route('restaurants.show', $restaurantId)->with('error', 'レビューを削除する権限がありません。');
    }
}
