@extends('layouts.admin')

@section('content')
  <div class="admin__container">
    <h1>レストラン一覧</h1>
    <table class="admin__table">
      <tr>
        <th>店名</th>
        <th>エリア</th>
        <th>料理の種類</th>
        <th>オーナー</th>
        <th>編集</th>
        <th>削除</th>
      </tr>
      @foreach ($restaurants as $restaurant)
        <tr>
          <td>{{ $restaurant->name }}</td>
          <td>{{ $restaurant->area->name }}</td>
          <td>{{ $restaurant->cuisineType->name }}</td>
          <td>{{ $restaurant->owner->name }}</td>
          <td><a href="{{ route('admin.edit-restaurant', $restaurant) }}" class="form__button">編集</a></td>
          <td>
            <form action="{{ route('admin.delete-restaurant', $restaurant) }}" method="POST"
              onsubmit="return confirm('本当に削除しますか？');">
              @csrf
              @method('DELETE')
              <button type="submit" class="form__button--danger">削除</button>
            </form>
          </td>
        </tr>
      @endforeach
    </table>
  </div>
@endsection
