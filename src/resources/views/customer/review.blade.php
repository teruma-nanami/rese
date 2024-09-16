@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>{{ $restaurant->name }}のレビューを投稿</h1>
    <form action="{{ route('reviews.store') }}" method="POST" class="form">
      @csrf
      <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
      <input type="hidden" name="review_date" value="{{ now() }}">
      <div class="form__text">
        <label for="rating">評価</label>
        <select name="rating" id="rating">
          <option value="1">☆</option>
          <option value="2">☆☆</option>
          <option value="3">☆☆☆</option>
          <option value="4">☆☆☆☆</option>
          <option value="5">☆☆☆☆☆</option>
        </select>
      </div>
      <div class="form__text">
        <label for="comment">コメント</label>
        <textarea name="comment" id="comment"></textarea>
      </div>
      <button type="submit" class="form__button">投稿</button>
    </form>
  </div>
@endsection
