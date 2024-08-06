<!-- resources/views/customer/mypage.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $user->name }}さんのマイページ</h1>

    <h2>予約した飲食店</h2>
    @if($reservations->isNotEmpty())
        <ul>
            @foreach($reservations as $reservation)
                <li>{{ $reservation->restaurant->name }} - {{ $reservation->reservation_date }}</li>
            @endforeach
        </ul>
    @else
        <p>予約はありません。</p>
    @endif

    <h2>お気に入りの飲食店</h2>
    @if($favoriteRestaurants->isNotEmpty())
        <ul>
            @foreach($favoriteRestaurants as $restaurant)
                <li>
                    {{ $restaurant->name }}
                    <form action="{{ route('favorites.remove', $restaurant) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">削除</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>お気に入りの飲食店はありません。</p>
    @endif
</div>
@endsection
