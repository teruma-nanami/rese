@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>{{ $restaurant->name }}の予約</h1>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <form action="{{ route('customer.reserve.store', $restaurant) }}" method="POST" class="form">
      @csrf
      <div class="form__text">
        <label for="reservation_date">予約日</label>
        <input type="date" name="reservation_date" class="form-control" value="{{ old('reservation_date') }}" required>
      </div>
      <div class="form__text">
        <label for="reservation_time">予約時間</label>
        <input type="time" name="reservation_time" class="form-control" value="{{ old('reservation_time') }}" required>
      </div>
      <div class="form__text">
        <label for="number_of_people">人数</label>
        <input type="number" name="number_of_people" class="form-control" value="{{ old('number_of_people') }}" required>
      </div>
      <div class="form__text">
        <label for="special_requests">特別なリクエスト</label>
        <textarea name="special_requests" class="form-control">{{ old('special_requests') }}</textarea>
      </div>
      <button type="submit" class="form__button">予約する</button>
    </form>
  </div>
@endsection
