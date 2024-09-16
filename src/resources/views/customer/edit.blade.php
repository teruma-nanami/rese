@extends('layouts.app')

@section('content')
  <div class="container">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <h1>予約の編集</h1>
    <form action="{{ route('reservations.confirm', $reservation) }}" method="POST" class="form">
      @csrf
      @method('POST')
      <div class="form__text">
        <label for="reservation_date">予約日</label>
        <input type="date" name="reservation_date" id="reservation_date" class="form-control"
          value="{{ old('reservation_date', $reservation->reservation_date) }}" required>
      </div>
      <div class="form__text">
        <label for="reservation_time">予約時間</label>
        <input type="time" name="reservation_time" id="reservation_time" class="form-control" step="60"
          value="{{ old('reservation_time', \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i')) }}" required>
      </div>
      <div class="form__text">
        <label for="number_of_people">人数</label>
        <input type="number" name="number_of_people" id="number_of_people" class="form-control"
          value="{{ old('number_of_people', $reservation->number_of_people) }}" required>
      </div>
      <div class="form__text">
        <label for="special_requests">特別なリクエスト</label>
        <textarea name="special_requests" id="special_requests" class="form-control">{{ old('special_requests', $reservation->special_requests) }}</textarea>
      </div>
      <button type="submit" class="form__button">更新</button>
    </form>
  </div>
@endsection
