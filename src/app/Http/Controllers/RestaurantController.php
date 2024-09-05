<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    public function show(Restaurant $restaurant)
    {
        return view('customer.detail', compact('restaurant'));
    }

    public function create()
    {
        return view('owner.create_restaurant');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:15'],
            'image_url' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'area' => ['required', 'string', 'max:255'],
            'cuisine_type' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('owner.create-restaurant')
                             ->withErrors($validator)
                             ->withInput();
        }

        $data = $request->all();
        $data['owner_id'] = Auth::id();

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

    public function confirm(Request $request, Restaurant $restaurant)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:15'],
            'image_url' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'area' => ['required', 'string', 'max:255'],
            'cuisine_type' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('owner.edit-restaurant', $restaurant)
                             ->withErrors($validator)
                             ->withInput();
        }

        $data = $request->all();
        return view('owner.confirm_restaurant', compact('data', 'restaurant'));
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        if (Auth::id() !== $restaurant->owner_id) {
            return redirect()->route('owner.create-restaurant')->with('error', '権限がありません。');
        }

        $restaurant->update($request->all());

        return redirect()->route('owner.edit-restaurant', $restaurant)->with('success', 'レストランが更新されました。');
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