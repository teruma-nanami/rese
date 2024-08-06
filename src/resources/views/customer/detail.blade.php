@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $restaurant->name }}</h1>
    @if($restaurant->image_url)
        <img src="{{ asset($restaurant->image_url) }}" alt="{{ $restaurant->name }}" class="img-fluid">
    @endif
    <p>住所: {{ $restaurant->address }}</p>
    <p>電話番号: {{ $restaurant->phone_number }}</p>
    <p>エリア: {{ $restaurant->area }}</p>
    <p>料理の種類: {{ $restaurant->cuisine_type }}</p>

    <h2>予約する</h2>
    <form action="{{ route('reservations.store', $restaurant) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="reservation_date">予約日</label>
            <input type="date" name="reservation_date" id="reservation_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="reservation_time">予約時間</label>
            <input type="time" name="reservation_time" id="reservation_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="number_of_people">人数</label>
            <input type="number" name="number_of_people" id="number_of_people" class="form-control" min="1" required>
        </div>
        <div class="form-group">
            <label for="special_requests">特別なリクエスト</label>
            <textarea name="special_requests" id="special_requests" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">予約する</button>
    </form>
</div>
@endsection
