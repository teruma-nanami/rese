@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>予約内容の確認</h1>
    <form action="{{ route('reservations.update', $reservation) }}" method="POST" class="form">
      @csrf
      @method('PATCH')
      <div class="form__text--confirm">
        <label for="reservation_date">予約日</label>
        <input type="date" name="reservation_date" id="reservation_date" value="{{ $data['reservation_date'] }}" readonly>
      </div>
      <div class="form__text--confirm">
        <label for="reservation_time">予約時間</label>
        <input type="time" name="reservation_time" id="reservation_time" value="{{ $data['reservation_time'] }}" readonly>
      </div>
      <div class="form__text--confirm">
        <label for="number_of_people">人数</label>
        <input type="number" name="number_of_people" id="number_of_people" value="{{ $data['number_of_people'] }}" readonly>
      </div>
      <div class="form__text--confirm">
        <label for="special_requests">特別なリクエスト</label>
        <textarea name="special_requests" id="special_requests" readonly>{{ $data['special_requests'] }}</textarea>
      </div>
      <button type="submit" class="form__button">確定</button>
    </form>
  </div>
@endsection
