@extends('layouts.app')

@section('content')
  <div class="container">
    <form action="{{ route('home.search') }}" method="GET" class="form">
      <div class="flex__inner">
        <div class="form__search">
          <select name="area">
            <option value="">エリアを選択</option>
            @foreach (['北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県', '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県', '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'] as $prefecture)
              <option value="{{ $prefecture }}">{{ $prefecture }}</option>
            @endforeach
          </select>
        </div>
        <div class="form__search">
          <select name="cuisine_type">
            <option value="">ジャンルを選択</option>
            <option value="寿司">寿司</option>
            <option value="焼肉">焼肉</option>
            <option value="ラーメン">ラーメン</option>
            <option value="イタリアン">イタリアン</option>
            <option value="居酒屋">居酒屋</option>
          </select>
        </div>
        <div class="form__search">
          <input type="text" name="keyword" placeholder="キーワード検索">
        </div>
        <div class="form__search">
          <button type="submit" class="form"><i class="bi bi-search"></i></button>
        </div>
      </div>
    </form>
    <div class="flex__inner">
      @foreach ($restaurants as $restaurant)
        <div class="card__inner">
          @if ($restaurant->image_url)
            <a href="{{ route('restaurants.show', $restaurant) }}"><img src="{{ asset($restaurant->image_url) }}"
                alt="{{ $restaurant->name }}"></a>
          @endif
          <div class="card__text">
            <h3>{{ $restaurant->name }}</h3>
            <p>#{{ $restaurant->area }} #{{ $restaurant->cuisine_type }}</p>
            <div class="card__link">
              <a href="{{ route('restaurants.show', $restaurant) }}">詳しくみる</a>
              <form action="{{ route('favorites.toggle', $restaurant) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit"
                  class="favorite-button {{ auth()->user()->favorites->contains($restaurant->id)? 'favorite__button--red': 'favorite__button--gray' }}">
                  ❤️
                </button>
              </form>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
