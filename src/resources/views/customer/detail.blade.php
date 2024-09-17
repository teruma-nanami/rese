@extends('layouts.app')

@section('content')
  <div class="container">
    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <div class="flex__inner">
      <div class="detail__card">
        <h1>{{ $restaurant->name }}</h1>
        @if ($restaurant->image_url)
          <img src="{{ asset($restaurant->image_url) }}" alt="{{ $restaurant->name }}" class="img-fluid">
        @endif
        <p>#{{ $restaurant->area }} #{{ $restaurant->cuisine_type }}</p>
        <p>{{ $restaurant->detail }}</p>
        <p>〒: {{ $restaurant->post_code }}</p>
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
        <h3>入力内容の確認</h3>
        <div id="reservation_summary">
          <p>予約日: <span id="summary_date"></span></p>
          <p>予約時間: <span id="summary_time"></span></p>
          <p>人数: <span id="summary_people"></span></p>
        </div>
      </div>
    </div>
    <div class="review">
      <h1>レビュー一覧</h1>
      @if ($reviews->isEmpty())
        <p>この店舗のレビューはまだありません。</p>
      @else
        @foreach ($reviews as $review)
          <div class="review__card">
            <p>投稿者: {{ $review->user->name }}</p>
            <p>評価:<span class="review__rating--text">
                @for ($i = 0; $i < $review->rating; $i++)
                  ★
                @endfor
                @for ($i = $review->rating; $i < 5; $i++)
                  ☆
                @endfor
              </span>
            </p>
            <p>コメント: {{ $review->comment }}</p>
            <p>投稿日時: {{ $review->review_date }}</p>
          </div>
        @endforeach
      @endif
      <a href="{{ route('reviews.create', ['store' => $restaurant->id]) }}" class="review__button">レビューを書く</a>
    </div>
  </div>
@endsection
