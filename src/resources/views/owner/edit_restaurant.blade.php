@extends('layouts.owner')

@section('content')
<div class="container">
    <h1>レストラン編集</h1>
    <form action="{{ route('owner.confirm-restaurant', $restaurant->id) }}" method="POST" class="form">
        @csrf
        @method('POST')
        <div class="form__text">
            <label for="name">名前</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $restaurant->name) }}" required>
        </div>
        <div class="form__text">
            <label for="address">住所</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $restaurant->address) }}" required>
        </div>
        <div class="form__text">
            <label for="phone_number">電話番号</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $restaurant->phone_number) }}" required>
        </div>
        <div class="form__text">
            <label for="image_url">画像URL</label>
            <input type="text" class="form-control" id="image_url" name="image_url" value="{{ old('image_url', $restaurant->image_url) }}">
        </div>
        <div class="form__text">
            <label for="email">メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $restaurant->email) }}">
        </div>
        <div class="form__text">
            <label for="area">エリア</label>
            <input type="text" class="form-control" id="area" name="area" value="{{ old('area', $restaurant->area) }}" required>
        </div>
        <div class="form__text">
            <label for="cuisine_type">料理の種類</label>
            <input type="text" class="form-control" id="cuisine_type" name="cuisine_type" value="{{ old('cuisine_type', $restaurant->cuisine_type) }}" required>
        </div>
        <button type="submit" class="form__button">更新</button>
    </form>
</div>
@endsection