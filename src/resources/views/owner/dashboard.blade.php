@extends('layouts.owner')

@section('content')
<div class="container">
    <h1>ダッシュボード</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2>予約一覧</h2>
    <table class="table">
        <thead>
            <tr>
                <th>顧客名</th>
                <th>レストラン名</th>
                <th>予約日</th>
                <th>予約時間</th>
                <th>人数</th>
                <th>特別なリクエスト</th>
                <th>ステータス</th>
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
                    <td>{{ $reservation->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
