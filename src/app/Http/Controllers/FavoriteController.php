<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\User;

class FavoriteController extends Controller {
    public function toggle(Restaurant $restaurant)
    {
        $user = auth()->user();

        if ($user->favorites->contains($restaurant->id)) {
            $user->favorites()->detach($restaurant->id);
            return redirect()->back()->with('status', 'お気に入りから削除しました');
        } else {
            if (!$user->favorites->contains($restaurant->id)) {
                $user->favorites()->attach($restaurant->id);
            }
            return redirect()->back()->with('status', 'お気に入りに追加しました');
        }
    }
}


