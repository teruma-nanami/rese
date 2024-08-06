<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('admin.restaurants', compact('restaurants'));
    }
    public function show(Restaurant $restaurant)
    {
        return view('customer.detail', compact('restaurant'));
    }
    public function create()
    {
        if (Auth::user()->role == 'admin') {
            $owners = User::where('role', 'restaurant_owner')->get();
            return view('admin.create_restaurant', compact('owners'));
        } else {
            return view('owner.create_restaurant');
        }
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
            'owner_id' => ['required', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.create-restaurant')
                             ->withErrors($validator)
                             ->withInput();
        }

        $data = $request->all();
        if (Auth::user()->role == 'admin') {
            $data['owner_id'] = $request->input('owner_id');
        } else {
            $data['owner_id'] = Auth::id();
        }

        Restaurant::create($data);

        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.create-restaurant')->with('success', 'レストランが作成されました。');
        } else {
            return redirect()->route('owner.create-restaurant')->with('success', 'レストランが作成されました。');
        }
    }
    public function edit(Restaurant $restaurant)
    {
        {
            if (Auth::id() !== $restaurant->owner_id) {
                return redirect()->route('owner.create-restaurant')->with('error', '権限がありません。');
            }
    
            return view('owner.edit_restaurant', compact('restaurant'));
        }
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
        $restaurant->delete();
        return redirect()->route('admin.restaurants')->with('success', 'レストランが削除されました。');
    }
}
