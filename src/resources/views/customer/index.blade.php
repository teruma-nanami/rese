@extends('layouts.app')

@section('content')
<div class="container">
    <h1>飲食店一覧</h1>
    <div class="row">
        @foreach($restaurants as $restaurant)
            <div class="col-md-4">
                <div class="card mb-4">
                    @if($restaurant->image_url)
                        <img src="{{ asset($restaurant->image_url) }}" class="card-img-top" alt="{{ $restaurant->name }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $restaurant->name }}</h5>
                        <p class="card-text">{{ $restaurant->area }}</p>
                        <p class="card-text">{{ $restaurant->cuisine_type }}</p>
                        <form action="{{ route('favorites.add', $restaurant) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">❤️</button>
                        </form>
                        <a href="{{ route('restaurants.show', $restaurant) }}" class="btn btn-primary btn-sm">詳しく見る</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
