@extends('layouts.app')

@section('content')
<div class="container flex__inner">
  <div class="detail__card">
    <h1>{{ $restaurant->name }}</h1>
    @if($restaurant->image_url)
      <img src="{{ asset($restaurant->image_url) }}" alt="{{ $restaurant->name }}" class="img-fluid">
    @endif
    <p>#{{ $restaurant->area }} #{{ $restaurant->cuisine_type }}</p>
    {{-- <p>{{ $restaurant->detail }}</p> --}}
    <p>住所: {{ $restaurant->address }}</p>
    <p>電話番号: {{ $restaurant->phone_number }}</p>
  </div>
  <div class="reservation__link">
    <a href="{{ route('customer.reserve', ['restaurant' => $restaurant->id]) }}">予約する</a>
  </div>
  <div class="reservation__card">
    <h2>予約</h2>
    <form action="{{ route('reservations.store', $restaurant) }}" method="POST">
        @csrf
        <div class="form__text">
            <label for="reservation_date">予約日</label>
            <input type="date" name="reservation_date" id="reservation_date" required>
        </div>
        <div class="form__text">
            <label for="reservation_time">予約時間</label>
            <input type="time" name="reservation_time" id="reservation_time" required>
        </div>
        <div class="form__text">
            <label for="number_of_people">人数</label>
            <input type="number" name="number_of_people" id="number_of_people" min="1" required>
        </div>
        <button type="submit" class="form__button">予約する</button>
    </form>
  </div>
</div>
@endsection
