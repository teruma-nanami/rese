<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\AdminRequest;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        $users = $query->where('role', '!=', 'admin')->get();
        return view('admin.manage_owners', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $user->role = $request->input('role');
        $user->save();

        return redirect()->route('admin.manage-owners')->with('success', 'ユーザーの役割が変更されました。');
    }

    public function search(Request $request)
    {
        $email = $request->input('email');
        $users = User::where('email', 'like', '%' . $email . '%')->where('role', '!=', 'admin')->get();

        return view('admin.manage_owners', compact('users'));
    }

    public function createOwnerForm()
    {
        return view('admin.make_owners');
    }

    public function storeOwner(StoreOwnerRequest $request)
    {
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'password' => Hash::make($request->input('password')),
            'password_digest' => Hash::make($request->input('password')),
            'role' => 'restaurant_owner',
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.manage-owners')->with('success', '飲食店オーナーが作成されました。');
    }

    public function deleteUser(User $user)
    {
        $user->delete();

        return redirect()->route('admin.manage-owners')->with('success', 'ユーザーが削除されました。');
    }
    public function indexRestaurants()
    {
        $restaurants = Restaurant::all();
        return view('admin.restaurants', compact('restaurants'));
    }

    public function create()
    {
        $owners = User::where('role', 'restaurant_owner')->get();
        return view('admin.create_restaurant', compact('owners'));
    }

    public function store(AdminRequest $request)
    {
        $data = $request->all();
        $data['owner_id'] = $request->input('owner_id');

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('images', 'public');
        }

        Restaurant::create($data);

        return redirect()->route('admin.create-restaurant')->with('success', 'レストランが作成されました。');
    }

    public function edit(Restaurant $restaurant)
    {
        $owners = User::where('role', 'restaurant_owner')->get();
        return view('admin.edit_restaurant', compact('restaurant', 'owners'));
    }

    public function update(AdminRequest $request, Restaurant $restaurant)
    {

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('images', 'public');
        }
        
        $restaurant->update($request->all());

        return redirect()->route('admin.edit-restaurant', $restaurant)->with('success', 'レストランが更新されました。');
    }

    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect()->route('admin.restaurants')->with('success', 'レストランが削除されました。');
    }
}
