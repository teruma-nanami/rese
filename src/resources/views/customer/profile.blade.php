@extends('layouts.app')

@section('content')
<div class="container">
    <h1>プロフィール更新</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" class="form">
        @csrf
        <div class="form__text">
            <label for="name">名前</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="form__text">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="form__text">
            <label for="phone_number">電話番号</label>
            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}">
        </div>
        <div class="form__text">
            <label for="password">パスワード</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form__text">
            <label for="password_confirmation">パスワード確認</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <button type="submit" class="form__button">更新</button>
    </form>
</div>
@endsection
