<!-- resources/views/admin/reviews/index.blade.php -->
@extends('layouts.admin')

@section('content')
  <div class="container">
    <h1>レビュー一覧</h1>
    @if ($reviews->isEmpty())
      <p>レビューはまだありません。</p>
    @else
      <table class="admin__table">
        <thead>
          <tr>
            <th>店舗名</th>
            <th>評価</th>
            <th class="admin__comment">コメント</th>
            <th>投稿日時</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($reviews as $review)
            <tr>
              <td>{{ $review->restaurant->name }}</td>
              <td>
                @for ($i = 0; $i < $review->rating; $i++)
                  ★
                @endfor
                @for ($i = $review->rating; $i < 5; $i++)
                  ☆
                @endfor
              </td>
              <td>{{ $review->comment }}</td>
              <td>{{ $review->review_date }}</td>
              <td>
                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST"
                  onsubmit="return confirm('このレビューを削除してもよろしいですか？');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="form__button--danger">削除</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>
@endsection
