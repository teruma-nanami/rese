@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>口コミを編集</h1>
    <form action="{{ route('reviews.update', $review->id) }}" method="POST" enctype="multipart/form-data" class="form">
      @csrf
      @method('PUT')

      <div class="form__text">
        <label for="rating">評価:</label>
        <input type="number" name="rating" value="{{ $review->rating }}" min="1" max="5" required>
      </div>

      <div class="form__text">
        <label for="comment">コメント:</label>
        <textarea name="comment">{{ $review->comment }}</textarea>
      </div>

      <div class="form__text">
        <label for="review_date">レビュー日:</label>
        <input type="date" name="review_date" value="{{ $review->review_date }}" required>
      </div>

      <div class="form__text">
        <label for="image">画像:</label>
        <input type="file" name="image" class="form__file">
        @if ($review->image_url)
          <img src="{{ Storage::url($review->image_url) }}" alt="現在の画像" width="300">
        @endif
      </div>

      <button type="submit">レビューを更新する</button>
    </form>
  </div>
@endsection
