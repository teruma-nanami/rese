@extends('layouts.owner')

@section('content')
  <div class="container">
    <h1>レストラン編集</h1>
    <form action="{{ route('owner.confirm-restaurant', $restaurant->id) }}" method="POST" class="form"
      enctype="multipart/form-data">
      @csrf
      @method('POST')
      <div class="form__text">
        <label for="name">名前</label>
        <input type="text" id="name" name="name" value="{{ old('name', $restaurant->name) }}" required>
      </div>
      <div class="form__text">
        <label for="post_code">郵便番号</label>
        <input type="text" name="post_code" value="{{ old('post_code', $restaurant->post_code) }}" required>
      </div>
      <div class="form__text">
        <label for="address">住所</label>
        <input type="text" id="address" name="address" value="{{ old('address', $restaurant->address) }}" required>
      </div>
      <div class="form__text">
        <label for="phone_number">電話番号</label>
        <input type="text" id="phone_number" name="phone_number"
          value="{{ old('phone_number', $restaurant->phone_number) }}" required>
      </div>
      <div class="form__text">
        <label for="image">画像</label>
        <input type="file" name="image">
      </div>
      <div class="form__text">
        <label for="email">メールアドレス</label>
        <input type="email" id="email" name="email" value="{{ old('email', $restaurant->email) }}">
      </div>
      <div class="form__text">
        <label for="area">エリア</label>
        <select name="area_id" required>
          <option value="">エリアを選択</option>
          @foreach ($areas as $area)
            <option value="{{ $area->id }}" {{ old('area_id', $restaurant->area_id) == $area->id ? 'selected' : '' }}>
              {{ $area->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form__text">
        <label for="cuisine_type">料理の種類</label>
        <select name="cuisine_type_id" required>
          <option value="">ジャンルを選択</option>
          @foreach ($cuisineTypes as $cuisineType)
            <option value="{{ $cuisineType->id }}"
              {{ old('cuisine_type_id', $restaurant->cuisine_type_id) == $cuisineType->id ? 'selected' : '' }}>
              {{ $cuisineType->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form__text">
        <label for="email">店舗説明</label>
        <textarea id="detail" name="detail">{{ old('detail', $restaurant->detail) }}</textarea>
      </div>
      <button type="submit" class="form__button">更新</button>
    </form>
  </div>
@endsection
