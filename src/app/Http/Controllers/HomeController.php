<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // $restaurants = Restaurant::all();
        // return view('customer.index', compact('restaurants'));
        return view('customer.index');
    }

    public function owner()
    {
        $reservations = Reservation::whereHas('restaurant', function ($query) {
            $query->where('owner_id', Auth::id());
        })->get();

        return view('owner.dashboard', compact('reservations'));
    }
}
