<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RestaurantRequest;

class RestaurantController extends Controller
{
    public function show(Restaurant $restaurant)
    {
        $reviews = Review::where('restaurant_id', $restaurant->id)->with('user')->get();

        return view('customer.detail', compact('restaurant', 'reviews'));
    }

    public function create()
    {
        return view('owner.create_restaurant');
    }

    public function store(RestaurantRequest $request)
    {
        $data = $request->all();
        $data['owner_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('images', 'public');
        }

        Restaurant::create($data);

        return redirect()->route('owner.create-restaurant')->with('success', 'レストランが作成されました。');
    }

    public function edit(Restaurant $restaurant)
    {
        if (Auth::id() !== $restaurant->owner_id) {
            return redirect()->route('owner.create-restaurant')->with('error', '権限がありません。');
        }

        return view('owner.edit_restaurant', compact('restaurant'));
    }

public function confirm(RestaurantRequest $request, $id)
{
    $data = $request->all();
    $restaurant = Restaurant::findOrFail($id);

    if (!$request->hasFile('image')) {
        $data['image_url'] = $restaurant->image_url ?? '';
    } else {
        $data['image_url'] = $request->file('image')->store('images', 'public');
    }

    return view('owner.confirm_restaurant', compact('data', 'restaurant'));
}

public function update(RestaurantRequest $request, $id)
{
    $restaurant = Restaurant::findOrFail($id);
    $data = $request->all();



    $restaurant->update($data);

    return redirect()->route('owner.edit-restaurant', $restaurant->id)->with('success', 'レストランが更新されました。');
}

    public function destroy(Restaurant $restaurant)
    {
        if (Auth::id() !== $restaurant->owner_id) {
            return redirect()->route('owner.restaurants')->with('error', '権限がありません。');
        }

        $restaurant->delete();
        return redirect()->route('owner.restaurants')->with('success', 'レストランが削除されました。');
    }
}
