<!-- resources/views/customer/mypage.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
	<h1>{{ $user->name }}さんのマイページ</h1>
	<div class="flex__inner">
		<div class="reservation-comfirm__card">
			<h2>予約状況</h2>
				@if($reservations->isNotEmpty())
					@foreach($reservations as $reservation)
						<div class="reservation-comfirm__inner">
							<h3>予約{{ $reservation->id }}</h3>
							<table>
								<tr>
									<th>Shop</th>
									<td>{{ $reservation->restaurant->name }}</td>
								</tr>
								<tr>
									<th>Date</th>
									<td>{{ $reservation->reservation_date }}</td>
								</tr>
								<tr>
									<th>Time</th>
									<td>{{ $reservation->reservation_time }}</td>
								</tr>
								<tr>
									<th>Number</th>
									<td>{{ $reservation->number_of_people }}人</td>
								</tr>
							</table>
						</div>
					@endforeach
				@else
					<p>予約はありません。</p>
				@endif
			
		</div>
		<div class="favorite__card">
			<h2>お気に入り店舗</h2>
			@if($favoriteRestaurants->isNotEmpty())
				@foreach($favoriteRestaurants as $restaurant)
					<div class="card__inner">
						@if($restaurant->image_url)
							<img src="{{ asset($restaurant->image_url) }}" alt="{{ $restaurant->name }}">
						@endif
						<div class="card__text">
							<h3>{{ $restaurant->name }}</h3>
							<p>#{{ $restaurant->area }} #{{ $restaurant->cuisine_type }}</p>
							<div class="card__link">
								<a href="{{ route('restaurants.show', $restaurant) }}" class="btn btn-primary btn-sm">詳しくみる</a>
								<form action="{{ route('favorites.add', $restaurant) }}" method="POST" style="display:inline;">
									@csrf
									<button type="submit" class="btn btn-outline-danger btn-sm">❤️</button>
								</form>
							</div>
						</div>
					</div>
				@endforeach
			@else
				<p>お気に入りの飲食店はありません。</p>
			@endif
		</div>
	</div>
</div>
@endsection
