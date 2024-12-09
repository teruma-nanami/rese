@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/review.css') }}" />
@endsection

@section('content')
  <div class="container">
    <h1>口コミを編集</h1>
    <form action="{{ route('reviews.update', $review->id) }}" method="POST" enctype="multipart/form-data" class="form">
      @csrf
      @method('PUT')

      <div class="form__text">
        <label for="rating">体験を再評価してください</label>
        <div class="rating">
          <input type="radio" name="rating" id="rating5" value="5" {{ $review->rating == 5 ? 'checked' : '' }}><label for="rating5">★</label>
          <input type="radio" name="rating" id="rating4" value="4" {{ $review->rating == 4 ? 'checked' : '' }}><label for="rating4">★</label>
          <input type="radio" name="rating" id="rating3" value="3" {{ $review->rating == 3 ? 'checked' : '' }}><label for="rating3">★</label>
          <input type="radio" name="rating" id="rating2" value="2" {{ $review->rating == 2 ? 'checked' : '' }}><label for="rating2">★</label>
          <input type="radio" name="rating" id="rating1" value="1" {{ $review->rating == 1 ? 'checked' : '' }}><label for="rating1">★</label>
        </div>
      </div>

      <div class="form__text">
        <label for="comment">口コミを投稿</label>
        <textarea name="comment" id="comment" rows="8" placeholder="カジュアルな夜のお出かけにおすすめのスポット">{{ old('comment', $review->comment) }}</textarea>
        <div id="charCount" class="comment__count">0/400（最高文字数）</div>
      </div>
      <div class="form__inner-file">
        <p>画像の変更</p>
        @if ($review->image_url)
          <img src="{{ Storage::url($review->image_url) }}" alt="現在の画像" width="300">
        @endif
        <input type="file" name="image" id="image">
      </div>
      <button type="submit" class="update__button">レビューを更新する</button>
    </form>
  </div>
@endsection
