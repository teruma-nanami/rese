@extends('layouts.owner')

@section('content')
  <div class="container">
    <h1>予約一覧</h1>
    <table class="owner-table">
      <thead>
        <tr>
          <th>顧客名</th>
          <th>レストラン名</th>
          <th>予約日</th>
          <th>予約時間</th>
          <th>人数</th>
          <th class="owner-table__request">備考</th>
          <th>ステータス</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($reservations as $reservation)
          <tr>
            <td>{{ $reservation->user->name }}</td>
            <td>{{ $reservation->restaurant->name }}</td>
            <td>{{ $reservation->reservation_date }}</td>
            <td>{{ $reservation->reservation_time }}</td>
            <td>{{ $reservation->number_of_people }}</td>
            <td>{{ $reservation->special_requests }}</td>
            <td>
              <form action="{{ route('reservations.updateStatus', $reservation->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <select name="status" onchange="this.form.submit()">
                  <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>来店前</option>
                  <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>確認中</option>
                  <option value="completed" {{ $reservation->status == 'completed' ? 'selected' : '' }}>完了</option>
                  <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>キャンセル</option>
                </select>
              </form>
            </td>
            <td>
              <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST"
                onsubmit="return confirm('本当に削除しますか？');">
                @csrf
                @method('DELETE')
                <button type="submit" class="form__button--danger">削除</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
