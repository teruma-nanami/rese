@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="detail__inner">
      <div class="detail__card">
        <h1>{{ $restaurant->name }}</h1>
        @if ($restaurant->image_url)
          <img src="{{ $restaurant->image_url }}" alt="{{ $restaurant->name }}">
        @endif
        <p>{{ $restaurant->area->name }} #{{ $restaurant->cuisineType->name }}</p>
        <p>{{ $restaurant->detail }}</p>
        <p>〒: {{ $restaurant->post_code }}</p>
        <p>住所: {{ $restaurant->address }}</p>
        <p>電話番号: {{ $restaurant->phone_number }}</p>
        <div class="review__inner">
          <h2>全ての口コミ情報</h2>
          @if ($reviews->isEmpty())
            <p>この店舗のレビューはまだありません。</p>
          @else
            @foreach ($reviews as $review)
              <div class="review__card">
                <div class="review__link">
                  <a href="{{ route('reviews.edit', $review->id) }}">口コミを編集</a>
                  <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">口コミを削除</button>
                  </form>
                </div>
                <p><span class="review__rating--add">
                    @for ($i = 0; $i < $review->rating; $i++)
                      ★
                    @endfor
                  </span>
                  <span class="review__rating--remove">
                    @for ($i = $review->rating; $i < 5; $i++)
                      ★
                    @endfor
                  </span>
                </p>
                <p>{{ $review->comment }}</p>
                @if ($review->image_url)
                  <p><img src="{{ Storage::url($review->image_url) }}" alt="レビュー画像"></p>
                @endif
              </div>
            @endforeach
          @endif
          <a href="{{ route('reviews.create', ['restaurant' => $restaurant->id]) }}" class="review__button">口コミを投稿する</a>
        </div>
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
        <div id="reservation_summary" class="reservation__summary">
          <p>店舗: {{ $restaurant->name }}</p>
          <p>予約日: <span id="summary_date"></span></p>
          <p>予約時間: <span id="summary_time"></span></p>
          <p>人数: <span id="summary_people"></span></p>
        </div>
      </div>
    </div>
  </div>
@endsection


