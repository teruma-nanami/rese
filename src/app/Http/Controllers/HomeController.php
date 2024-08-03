<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $restaurants = Restaurant::all();
        // return view('customer.index', compact('restaurants'));
        return view('customer.index');
    }
}
