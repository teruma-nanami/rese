@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>レストラン編集</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.update-restaurant', $restaurant) }}" method="POST" class="form">
        @csrf
        <div class="form__text">
            <label for="name">名前</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $restaurant->name) }}" required>
        </div>
        <div class="form__text">
            <label for="address">住所</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $restaurant->address) }}" required>
        </div>
        <div class="form__text">
            <label for="phone_number">電話番号</label>
            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $restaurant->phone_number) }}" required>
        </div>
        <div class="form__text">
            <label for="image_url">画像URL</label>
            <input type="text" name="image_url" class="form-control" value="{{ old('image_url', $restaurant->image_url) }}">
        </div>
        <div class="form__text">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $restaurant->email) }}">
        </div>
        <div class="form__text">
            <label for="area">エリア</label>
            <input type="text" name="area" class="form-control" value="{{ old('area', $restaurant->area) }}" required>
        </div>
        <div class="form__text">
            <label for="cuisine_type">料理の種類</label>
            <input type="text" name="cuisine_type" class="form-control" value="{{ old('cuisine_type', $restaurant->cuisine_type) }}" required>
        </div>
        <div class="form__text">
            <label for="owner_id">オーナー</label>
            <select name="owner_id" class="form-control" required>
                @foreach ($owners as $owner)
                    <option value="{{ $owner->id }}" {{ $restaurant->owner_id == $owner->id ? 'selected' : '' }}>{{ $owner->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="form__button">更新</button>
    </form>
</div>
@endsection
