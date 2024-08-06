@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>ユーザー管理</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.search') }}" method="GET" class="form-inline mb-3">
        <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="メールアドレスで検索" value="{{ request('email') }}">
        </div>
        <button type="submit" class="btn btn-primary ml-2">検索</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>役割</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form action="{{ route('admin.update-role', $user) }}" method="POST">
                            @csrf
                            <select name="role" class="form-control" onchange="this.form.submit()">
                                <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>一般ユーザー</option>
                                <option value="restaurant_owner" {{ $user->role == 'restaurant_owner' ? 'selected' : '' }}>飲食店オーナー</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <!-- 他の操作があればここに追加 -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
