@extends('layouts.owner')

@section('content')
  <div class="container">
    <h1>レストラン編集</h1>
    <form action="{{ route('owner.confirm-restaurant', $restaurant->id) }}" method="POST" class="form">
      @csrf
      @method('POST')
      <div class="form__text">
        <label for="name">名前</label>
        <input type="text" id="name" name="name" value="{{ old('name', $restaurant->name) }}"
          required>
      </div>
      <div class="form__text">
        <label for="post_code">郵便番号</label>
        <input type="text" name="post_code" value="{{ old('post_code', $restaurant->post_code) }}" required>
      </div>
      <div class="form__text">
        <label for="address">住所</label>
        <input type="text" id="address" name="address"
          value="{{ old('address', $restaurant->address) }}" required>
      </div>
      <div class="form__text">
        <label for="phone_number">電話番号</label>
        <input type="text" id="phone_number" name="phone_number"
          value="{{ old('phone_number', $restaurant->phone_number) }}" required>
      </div>
      <div class="form__text">
        <label for="image_url">画像URL</label>
        <input type="text" id="image_url" name="image_url"
          value="{{ old('image_url', $restaurant->image_url) }}">
      </div>
      <div class="form__text">
        <label for="email">メールアドレス</label>
        <input type="email" id="email" name="email"
          value="{{ old('email', $restaurant->email) }}">
      </div>
      <div class="form__text">
        <label for="area">エリア</label>
        <select name="area" required>
          <option value="{{ old('area', $restaurant->area) }}">エリアを選択</option>
          @foreach (['北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県', '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県', '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'] as $prefecture)
            <option value="{{ $prefecture }}">{{ $prefecture }}</option>
          @endforeach
        </select>
      </div>
      <div class="form__text">
        <label for="cuisine_type">料理の種類</label>
        <select name="cuisine_type" required>
          <option value="{{ old('area', $restaurant->cuisine_type) }}">ジャンルを選択</option>
          <option value="寿司">寿司</option>
          <option value="焼肉">焼肉</option>
          <option value="ラーメン">ラーメン</option>
          <option value="イタリアン">イタリアン</option>
          <option value="居酒屋">居酒屋</option>
        </select>
      </div>
      <button type="submit" class="form__button">更新</button>
    </form>
  </div>
@endsection
