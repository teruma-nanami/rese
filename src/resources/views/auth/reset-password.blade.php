@extends('layouts.application')

@section('content')
<div class="container">
  <h2>Password Reset</h2>
  <form method="POST" action="{{ route('password.update') }}" class="form">
    @csrf
    <input type="hidden" name="token" value="{{ $request->route('token') }}">
    <div class="form__inner">
      <div class="form__inner-text">
        <label for="email">メールアドレス</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
      </div>
      <div class="form__inner-text">
        <label for="password">パスワード</label>
        <input id="password" type="password" name="password" required>
      </div>
      <div class="form__inner-text">
        <label for="password_confirmation">確認用パスワード</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
      </div>
      <div class="form__button">
        <button type="submit">パスワードを再設定</button>
      </div>
    </div>
  </form>
</div>
@endsection
