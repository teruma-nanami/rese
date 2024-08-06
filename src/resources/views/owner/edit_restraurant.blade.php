@extends('layouts.owner')

@section('content')
<div class="container">
    <h1>レストラン確認</h1>
    <form action="{{ route('owner.update-restaurant', $restaurant) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">名前</label>
            <input type="text" name="name" class="form-control" value="{{ $data['name'] }}" readonly>
        </div>
        <div class="form-group">
            <label for="address">住所</label>
            <input type="text" name="address" class="form-control" value="{{ $data['address'] }}" readonly>
        </div>
        <div class="form-group">
            <label for="phone_number">電話番号</label>
            <input type="text" name="phone_number" class="form-control" value="{{ $data['phone_number'] }}" readonly>
        </div>
        <div class="form-group">
            <label for="image_url">画像URL</label>
            <input type="text" name="image_url" class="form-control" value="{{ $data['image_url'] }}" readonly>
        </div>
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" class="form-control" value="{{ $data['email'] }}" readonly>
        </div>
        <div class="form-group">
            <label for="area">エリア</label>
            <input type="text" name="area" class="form-control" value="{{ $data['area'] }}" readonly>
        </div>
        <div class="form-group">
            <label for="cuisine_type">料理の種類</label>
            <input type="text" name="cuisine_type" class="form-control" value="{{ $data['cuisine_type'] }}" readonly>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
    </form>
    <form action="{{ route('owner.edit-restaurant', $restaurant) }}" method="GET">
        <button type="submit" class="btn btn-secondary">戻る</button>
    </form>
</div>
@endsection
