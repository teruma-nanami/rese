@extends('layouts.app')

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
              <form action="{{ route('favorites.toggle', $restaurant) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit"
                  class="favorite-button {{ auth()->user()->favorites->contains($restaurant->id)? 'favorite__button--red': 'favorite__button--gray' }}">❤️</button>
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
            <select name="rating" id="rating">
              <option value="1">☆</option>
              <option value="2">☆☆</option>
              <option value="3">☆☆☆</option>
              <option value="4">☆☆☆☆</option>
              <option value="5">☆☆☆☆☆</option>
            </select>
          </div>
          <div class="form__text">
            <label for="comment">口コミを投稿</label>
            <textarea name="comment" id="comment"></textarea>
          </div>
          <div class="form__text">
            <label for="image">画像:</label>
            <input type="file" name="image">
            <!-- エラーメッセージ表示 -->
            @if ($errors->has('image'))
              <div class="error">{{ $errors->first('image') }}</div>
            @endif
          </div>
          <button type="submit" class="form__button">口コミを投稿</button>
        </form>
      </div>
    </div>
  </div>
@endsection
