<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest;

class ReservationController extends Controller
{
    public function create(Restaurant $restaurant)
    {
        return view('customer.reservation', compact('restaurant'));
    }

    public function store(ReservationRequest $request, Restaurant $restaurant)
    {
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

    public function edit(Reservation $reservation)
    {
        return view('customer.edit', compact('reservation'));
    }

    public function update(ReservationRequest $request, Reservation $reservation)
    {
        $reservation->update($request->all());

        return redirect()->route('mypage.show')->with('status', '予約が更新されました');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('mypage.show')->with('status', '予約が削除されました');
    }
}

