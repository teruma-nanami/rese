@extends('layouts.app')

@section('content')
<div class="container">
    <h1>レビューを作成</h1>
    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="restaurant_id">レストラン</label>
            <select name="restaurant_id" id="restaurant_id" class="form-control">
                @foreach($restaurants as $restaurant)
                    <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="rating">評価</label>
            <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" required>
        </div>
        <div class="form-group">
            <label for="comment">コメント</label>
            <textarea name="comment" id="comment" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="review_date">レビュー日</label>
            <input type="date" name="review_date" id="review_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">送信</button>
    </form>
</div>
@endsection
