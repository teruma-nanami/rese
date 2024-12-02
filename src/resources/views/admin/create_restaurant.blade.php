@extends('layouts.admin')

@section('content')
  <div class="container">
    <h1>レストラン作成</h1>
    <form action="{{ route('admin.store-restaurant') }}" method="POST" class="form">
      @csrf
      <div class="form__text">
        <label for="name">名前</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
      </div>
      <div class="form__text">
        <label for="post_code">郵便番号</label>
        <input type="text" name="post_code" value="{{ old('post_code') }}" required>
      </div>
      <div class="form__text">
        <label for="address">住所</label>
        <input type="text" name="address" value="{{ old('address') }}" required>
      </div>
      <div class="form__text">
        <label for="phone_number">電話番号</label>
        <input type="text" name="phone_number" value="{{ old('phone_number') }}" required>
      </div>
      <div class="form__text">
        <label for="image_url">画像URL</label>
        <input type="text" name="image_url" value="{{ old('image_url') }}">
      </div>
      <div class="form__text">
        <label for="email">メールアドレス</label>
        <input type="email" name="email" value="{{ old('email') }}">
      </div>
      <div class="form__text">
        <label for="area">エリア</label>
        <select name="area_id" required>
          <option value="">エリアを選択</option>
          @foreach ($areas as $area)
            <option value="{{ $area->id }}" {{ old('area_id') == $area->id ? 'selected' : '' }}>{{ $area->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="form__text">
        <label for="cuisine_type">料理の種類</label>
        <select name="cuisine_type_id" required>
          <option value="">ジャンルを選択</option>
          @foreach ($cuisineTypes as $cuisineType)
            <option value="{{ $cuisineType->id }}" {{ old('cuisine_type_id') == $cuisineType->id ? 'selected' : '' }}>
              {{ $cuisineType->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form__text">
        <label for="owner_id">オーナー</label>
        <select name="owner_id" required>
          @foreach ($owners as $owner)
            <option value="{{ $owner->id }}">{{ $owner->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form__text">
        <label for="email">店舗説明</label>
        <textarea id="detail" name="detail">{{ old('detail') }}</textarea>
      </div>
      <button type="submit" class="form__button">作成</button>
    </form>
  </div>
@endsection
