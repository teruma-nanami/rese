<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\HomeRequest;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Restaurant::query()->with(['area', 'cuisineType']); // ここでwithメソッドを使用

        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->input('keyword') . '%');
        }

        if ($request->filled('area')) {
            $query->whereHas('area', function ($q) use ($request) {
                $q->where('name', $request->input('area'));
            });
        }

        if ($request->filled('cuisine_type')) {
            $query->whereHas('cuisineType', function ($q) use ($request) {
                $q->where('name', $request->input('cuisine_type'));
            });
        }

        if ($request->filled('sort')) {
            switch ($request->input('sort')) {
                case 'rating_high':
                    $query->withAvg('reviews', 'rating')->orderByDesc('reviews_avg_rating');
                    break;
                case 'rating_low':
                    $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating');
                    break;
                case 'random':
                    $query->inRandomOrder();
                    break;
            }
        }

        $restaurants = $query->get();

        return view('customer.index', compact('restaurants'));
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('customer.profile', compact('user'));
    }

    public function updateProfile(HomeRequest $request)
    {
        $user = Auth::user();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'プロフィールが更新されました。');
    }

    public function showMyPage()
    {
        $user = Auth::user();
        $reservations = $user->reservations()->where('reservation_date', '>=', now()->toDateString())->get(); // 予約情報を取得
        $favoriteRestaurants = $user->favorites; // お気に入りのレストランを取得

        return view('customer.mypage', compact('user', 'reservations', 'favoriteRestaurants'));
    }

    public function owner()
    {
        $reservations = Reservation::whereHas('restaurant', function ($query) {
            $query->where('owner_id', Auth::id());
        })->get();

        return view('owner.dashboard', compact('reservations'));
    }

    public function indexRestaurants()
    {
        $restaurants = Restaurant::where('owner_id', Auth::id())->get();
        return view('owner.restaurants', compact('restaurants'));
    }
}
