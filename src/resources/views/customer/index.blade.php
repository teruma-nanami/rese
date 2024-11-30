@extends('layouts.app')

@section('content')
  <div class="container">
    <form action="{{ route('home.search') }}" method="GET" class="form">
      <div class="search__inner">
        <div class="flex__inner">
          <div class="form__search">
            <select name="sort">
              <option value="">並び替え:評価高/低</option>
              <option value="random">ランダム</option>
              <option value="rating_high">評価が高い順</option>
              <option value="rating_low">評価が低い順</option>
            </select>
          </div>
          <div class="form__search">
            <select name="area">
              <option value="">All area</option>
              <option value="東京都">東京都</option>
              <option value="大阪府">大阪府</option>
              <option value="福岡県">福岡県</option>
            </select>
          </div>
          <div class="form__search">
            <select name="cuisine_type">
              <option value="">All genre</option>
              <option value="寿司">寿司</option>
              <option value="焼肉">焼肉</option>
              <option value="居酒屋">居酒屋</option>
              <option value="イタリアン">イタリアン</option>
              <option value="ラーメン">ラーメン</option>
            </select>
          </div>
          <div class="form__search">
            <input type="text" name="keyword" placeholder="Search...">
          </div>
          <div class="form__search">
            <button type="submit" class="form"><i class="bi bi-search"></i></button>
          </div>
        </div>
      </div>
    </form>
    <div class="flex__inner">
      @foreach ($restaurants as $restaurant)
        <div class="card__inner">
          @if ($restaurant->image_url)
            <a href="{{ route('restaurants.show', $restaurant) }}">
              <img src="{{ $restaurant->image_url }}" alt="{{ $restaurant->name }}">
            </a>
          @endif
          <div class="card__text">
            <h3>{{ $restaurant->name }}</h3>
            <p>{{ $restaurant->area->name }} #{{ $restaurant->cuisineType->name }}</p>
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
