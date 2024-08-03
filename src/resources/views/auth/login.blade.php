@extends('layouts.application')

@section('content')
  <div class="container">
    <h2>Login</h2>
    <form action="/login" method="post" class="form">
      @csrf
      <div class="form__inner">
        <div class="form__inner-text">
          <input type="text" name="email" placeholder="email">
        </div>
        <div class="form__error">
          @error('email')
          {{ $message }}
          @enderror
        </div>
        <div class="form__inner-text">
          <input type="password" name="password" placeholder="Password">
        </div>
        <div class="form__error">
          @error('password')
          {{ $message }}
          @enderror
        </div>
        <div class="form__inner-check">
          <label for="remember_me">
              <input id="remember_me" type="checkbox" name="remember"><span> ログイン状態を保存する</span>
          </label>
        </div>
        <div class="form__button">
          <button type="submit">ログイン</button>
        </div>
      </div>
    </form>
  </div>
@endsection