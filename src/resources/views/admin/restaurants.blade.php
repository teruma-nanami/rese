@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>レストラン一覧</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>名前</th>
                <th>住所</th>
                <th>電話番号</th>
                <th>エリア</th>
                <th>料理の種類</th>
                <th>オーナー</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($restaurants as $restaurant)
                <tr>
                    <td>{{ $restaurant->name }}</td>
                    <td>{{ $restaurant->address }}</td>
                    <td>{{ $restaurant->phone_number }}</td>
                    <td>{{ $restaurant->area }}</td>
                    <td>{{ $restaurant->cuisine_type }}</td>
                    <td>{{ $restaurant->owner->name }}</td>
                    <td>
                        <a href="{{ route('admin.edit-restaurant', $restaurant) }}" class="btn btn-primary">編集</a>
                        <form action="{{ route('admin.delete-restaurant', $restaurant) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
