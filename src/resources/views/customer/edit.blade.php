@extends('layouts.app')

@section('content')
<div class="container">
    <h1>予約の編集</h1>
    <form action="{{ route('reservations.update', $reservation) }}" method="POST" class="form">
        @csrf
        @method('PUT')
        <div class="form__text">
            <label for="reservation_date">予約日</label>
            <input type="date" name="reservation_date" id="reservation_date" class="form-control" value="{{ $reservation->reservation_date }}" required>
        </div>
        <div class="form__text">
            <label for="reservation_time">予約時間</label>
            <input type="time" name="reservation_time" id="reservation_time" class="form-control" value="{{ $reservation->reservation_time }}" required>
        </div>
        <div class="form__text">
            <label for="number_of_people">人数</label>
            <input type="number" name="number_of_people" id="number_of_people" class="form-control" value="{{ $reservation->number_of_people }}" required>
        </div>
        <button type="submit" class="form__button">更新</button>
    </form>
</div>
@endsection
