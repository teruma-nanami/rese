@extends('layouts.owner')

@section('content')
  <div class="container">
    <h1>レストラン編集確認</h1>
    <form action="{{ route('owner.update-restaurant', $restaurant->id) }}" method="POST" class="form">
      @csrf
      @method('PATCH')
      <div class="form__text--confirm">
        <label for="name">名前</label>
        <input type="text" id="name" name="name" value="{{ $data['name'] }}" readonly>
      </div>
      <div class="form__text--confirm">
        <label for="post_code">郵便番号</label>
        <input type="text" name="post_code" value="{{ $data['post_code'] }}" required>
      </div>
      <div class="form__text--confirm">
        <label for="address">住所</label>
        <input type="text" id="address" name="address" value="{{ $data['address'] }}" readonly>
      </div>
      <div class="form__text--confirm">
        <label for="phone_number">電話番号</label>
        <input type="text" id="phone_number" name="phone_number" value="{{ $data['phone_number'] }}" readonly>
      </div>
      <div class="form__text--confirm">
        <label for="image_url">画像URL</label>
        <input type="text" id="image_url" name="image_url" value="{{ $data['image_url'] }}" readonly>
      </div>
      <div class="form__text--confirm">
        <label for="email">メールアドレス</label>
        <input type="email" id="email" name="email" value="{{ $data['email'] }}" readonly>
      </div>

    <!-- 確認画面用のフィールド -->
    <div class="form__text--confirm">
        <label for="area">エリア</label>
        <input type="text" id="area" name="area" value="{{ $areas->find($data['area_id'])->name }}" readonly>
        <input type="hidden" name="area_id" value="{{ $data['area_id'] }}">
    </div>
    <div class="form__text--confirm">
        <label for="cuisine_type">料理の種類</label>
        <input type="text" id="cuisine_type" name="cuisine_type" value="{{ $cuisineTypes->find($data['cuisine_type_id'])->name }}" readonly>
        <input type="hidden" name="cuisine_type_id" value="{{ $data['cuisine_type_id'] }}">
    </div>



      <div class="form__text--confirm">
        <label for="email">店舗説明</label>
        <textarea id="detail" name="detail"readonly>{{ $data['detail'] }}</textarea>
      </div>
      <button type="submit" class="form__button">確定</button>
      <a href="{{ route('owner.edit-restaurant', $restaurant->id) }}" class="form__button--danger">戻る</a>
    </form>
  </div>
@endsection
