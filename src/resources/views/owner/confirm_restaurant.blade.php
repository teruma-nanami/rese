@extends('layouts.owner')

@section('content')
<div class="container">
    <h1>レストラン編集確認</h1>
    <form action="{{ route('owner.update-restaurant', $restaurant->id) }}" method="POST" class="form">
        @csrf
        @method('POST')
        <div class="form__text">
            <label for="name">名前</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $data['name'] }}" readonly>
        </div>
        <div class="form__text">
            <label for="address">住所</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $data['address'] }}" readonly>
        </div>
        <div class="form__text">
            <label for="phone_number">電話番号</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $data['phone_number'] }}" readonly>
        </div>
        <div class="form__text">
            <label for="image_url">画像URL</label>
            <input type="text" class="form-control" id="image_url" name="image_url" value="{{ $data['image_url'] }}" readonly>
        </div>
        <div class="form__text">
            <label for="email">メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $data['email'] }}" readonly>
        </div>
        <div class="form__text">
            <label for="area">エリア</label>
            <input type="text" class="form-control" id="area" name="area" value="{{ $data['area'] }}" readonly>
        </div>
        <div class="form__text">
            <label for="cuisine_type">料理の種類</label>
            <input type="text" class="form-control" id="cuisine_type" name="cuisine_type" value="{{ $data['cuisine_type'] }}" readonly>
        </div>
        <button type="submit" class="form__button">確定</button>
        <a href="{{ route('owner.edit-restaurant', $restaurant->id) }}" class="form__button--danger">戻る</a>
    </form>
</div>
@endsection
