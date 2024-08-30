@extends('layouts.admin')

@section('content')
<div class="admin__container">
    <h1>飲食店オーナー作成</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.store-owner') }}" method="POST" class="form">
        @csrf
        <div class="form__text">
            <label for="name">名前</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form__text">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form__text">
            <label for="phone_number">電話番号</label>
            <input type="text" name="phone_number" value="{{ old('phone_number') }}">
        </div>
        <div class="form__text">
            <label for="password">パスワード</label>
            <input type="password" name="password" required>
        </div>
        <div class="form__text">
            <label for="password_confirmation">パスワード確認</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <button type="submit" class="form__button">作成</button>
    </form>
</div>
@endsection
