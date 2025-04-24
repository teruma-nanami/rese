@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/review.css') }}" />
@endsection

@section('content')
  <div class="container">
    <div class="flex__inner">
      <div class="use__inner">
        <h1>今回のご利用はいかがでしたか？</h1>
        <div class="card__inner">
          @if ($restaurant->image_url)
            <img src="{{ $restaurant->image_url }}" alt="{{ $restaurant->name }}">
          @endif
          <div class="card__text">
            <h3>{{ $restaurant->name }}</h3>
            <p>{{ $restaurant->area->name }} #{{ $restaurant->cuisineType->name }}</p>
            <div class="card__link">
              <a href="{{ route('restaurants.show', $restaurant) }}" class="btn btn-primary btn-sm">詳しくみる</a>
              <form action="{{ route('favorites.toggle', $restaurant) }}" method="POST" class="favorite__form">
                @csrf
                <button type="submit"
                  class="favorite-button {{ auth()->user()->favorites->contains($restaurant->id)? 'favorite__button--red': 'favorite__button--gray' }}"><i
                    class="bi bi-heart-fill"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="review__form">
        <form action="{{ route('reviews.store') }}" method="POST" class="form" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
          <input type="hidden" name="review_date" value="{{ now() }}">
          <div class="form__text">
            <label for="rating">体験を評価してください</label>
            <div class="rating">
              <input type="radio" name="rating" id="rating5" value="5"><label for="rating5">★</label>
              <input type="radio" name="rating" id="rating4" value="4"><label for="rating4">★</label>
              <input type="radio" name="rating" id="rating3" value="3" checked><label for="rating3">★</label>
              <input type="radio" name="rating" id="rating2" value="2"><label for="rating2">★</label>
              <input type="radio" name="rating" id="rating1" value="1"><label for="rating1">★</label>
            </div>
          </div>
          <div class="form__text">
            <label for="comment">口コミを投稿</label>
            <textarea name="comment" id="comment" rows="8" placeholder="カジュアルな夜のお出かけにおすすめのスポット"></textarea>
            <div id="charCount" class="comment__count">0/400（最高文字数）</div>
          </div>
          <div class="form__inner-file">
            <p>画像の追加</p>
            <label for="image">
              <span class="form__file">クリックして画像を追加</span>
            </label>
            <input type="file" name="image" id="image" hidden>
          </div>
            <!-- エラーメッセージ表示 -->
            @if ($errors->has('image'))
              <div class="error">{{ $errors->first('image') }}</div>
            @endif
          <button type="submit" class="form__button">口コミを投稿</button>
        </form>
      </div>
    </div>
  </div>
@endsection
