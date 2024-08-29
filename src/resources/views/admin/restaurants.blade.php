@extends('layouts.admin')

@section('content')
<div class="admin__container">
    <h1>レストラン一覧</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="admin__table">
        <tr>
            <th>店名</th>
            <th>エリア</th>
            <th>料理の種類</th>
            <th>オーナー</th>
            <th>操作</th>
        </tr>
        @foreach ($restaurants as $restaurant)
            <tr>
                <td>{{ $restaurant->name }}</td>
                <td>{{ $restaurant->area }}</td>
                <td>{{ $restaurant->cuisine_type }}</td>
                <td>{{ $restaurant->owner->name }}</td>
                <td>
                    <a href="{{ route('admin.edit-restaurant', $restaurant) }}">編集</a>
                    <form action="{{ route('admin.delete-restaurant', $restaurant) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{-- <div class="page__nav">
        {{ $users->appends(['date' => $date])->links() }}
      </div> --}}
</div>
@endsection
