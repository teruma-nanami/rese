@extends('layouts.admin')

@section('content')
  <div class="admin__container">
    <h1>ユーザー管理</h1>
    <form action="{{ route('admin.search') }}" method="GET" class="form">
      <div class="form__inner">
        <input type="text" name="email" class="form__search" placeholder="メールアドレスで検索" value="{{ request('email') }}">
        <button type="submit" class="form__search-button"><i class="bi bi-search"></i></button>
      </div>
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
                <select name="role" onchange="this.form.submit()" class="form__role">
                  <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>一般ユーザー</option>
                  <option value="restaurant_owner" {{ $user->role == 'restaurant_owner' ? 'selected' : '' }}>飲食店オーナー</option>
                </select>
              </form>
            </td>
            <td>
              <form action="{{ route('admin.delete-user', $user) }}" method="POST"
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
