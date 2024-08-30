<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    public function create(Restaurant $restaurant)
    {
        return view('customer.reservation', compact('restaurant'));
    }

    public function store(Request $request, Restaurant $restaurant)
    {
        $validator = Validator::make($request->all(), [
            'reservation_date' => ['required', 'date'],
            'reservation_time' => ['required', 'date_format:H:i'],
            'number_of_people' => ['required', 'integer', 'min:1'],
            'special_requests' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('customer.reserve', $restaurant)
                             ->withErrors($validator)
                             ->withInput();
        }

        Reservation::create([
            'user_id' => Auth::id(),
            'restaurant_id' => $restaurant->id,
            'reservation_date' => $request->input('reservation_date'),
            'reservation_time' => $request->input('reservation_time'),
            'number_of_people' => $request->input('number_of_people'),
            'special_requests' => $request->input('special_requests'),
            'status' => 'pending',
        ]);

        return redirect()->route('reservations.done');
    }

    public function done()
    {
        return view('customer.done');
    }
}

