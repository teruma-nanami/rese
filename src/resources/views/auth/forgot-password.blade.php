@extends('layouts.application')

@section('content')
  <div class="container">
  <h2>Password Reset</h2>
  <form method="POST" action="{{ route('password.email') }}" class="form">
    @csrf
    <div class="form__inner">
      <div class="form__inner-text">
        <p>メールアドレスを入力後、認証を行います。</p>
        <label for="email"></label>
        <input id="email" type="email" name="email" placeholder="email" required autofocus>
      </div>
      <div class="form__button">
        <button type="submit">送信</button>
      </div>
    </div>
  </form>
</div>
@endsection