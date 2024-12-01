@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>口コミを編集</h2>
    <form action="{{ route('reviews.update', $review->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label for="rating">評価:</label>
        <input type="number" name="rating" class="form-control" value="{{ $review->rating }}" min="1" max="5"
          required>
        @if ($errors->has('rating'))
          <div class="alert alert-danger">{{ $errors->first('rating') }}</div>
        @endif
      </div>

      <div class="form-group">
        <label for="comment">コメント:</label>
        <textarea name="comment" class="form-control">{{ $review->comment }}</textarea>
        @if ($errors->has('comment'))
          <div class="alert alert-danger">{{ $errors->first('comment') }}</div>
        @endif
      </div>

      <div class="form-group">
        <label for="review_date">レビュー日:</label>
        <input type="date" name="review_date" class="form-control" value="{{ $review->review_date }}" required>
        @if ($errors->has('review_date'))
          <div class="alert alert-danger">{{ $errors->first('review_date') }}</div>
        @endif
      </div>

      <div class="form-group">
        <label for="image">画像:</label>
        <input type="file" name="image" class="form-control">
        @if ($errors->has('image'))
          <div class="alert alert-danger">{{ $errors->first('image') }}</div>
        @endif
        @if ($review->image_url)
          <div class="mt-2">
            <img src="{{ Storage::url($review->image_url) }}" alt="現在の画像" style="max-width: 200px;">
          </div>
        @endif
      </div>

      <button type="submit" class="btn btn-primary">レビューを更新する</button>
    </form>
  </div>
@endsection
