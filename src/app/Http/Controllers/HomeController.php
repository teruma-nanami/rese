<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\HomeRequest;

class HomeController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
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
        $user = auth()->user();
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
