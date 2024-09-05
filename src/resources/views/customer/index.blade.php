@extends('layouts.app')

@section('content')
<div class="container">
  <div class="flex__inner">
    @foreach($restaurants as $restaurant)
      <div class="card__inner">
        @if($restaurant->image_url)
          <img src="{{ asset($restaurant->image_url) }}" alt="{{ $restaurant->name }}">
        @endif
        <div class="card__text">
          <h3>{{ $restaurant->name }}</h3>
          <p>#{{ $restaurant->area }} #{{ $restaurant->cuisine_type }}</p>
          <div class="card__link">
            <a href="{{ route('restaurants.show', $restaurant) }}" class="btn btn-primary btn-sm">詳しくみる</a>
            <form action="{{ route('favorites.toggle', $restaurant) }}" method="POST" style="display:inline;">
              @csrf
              <button type="submit" class="btn btn-sm favorite-button {{ auth()->user()->favorites->contains($restaurant->id) ? 'btn-danger' : 'btn-outline-danger' }}">
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

@section('scripts')
<script src="{{ asset('js/toggle.js') }}"></script>
@endsection
