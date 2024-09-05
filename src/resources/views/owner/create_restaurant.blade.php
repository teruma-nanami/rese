@extends('layouts.owner')

@section('content')
<div class="container">
    <h1>レストラン作成</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.store-restaurant') }}" method="POST" class="form">
        @csrf
        <div class="form__text">
            <label for="name">名前</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="form__text">
            <label for="address">住所</label>
            <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
        </div>
        <div class="form__text">
            <label for="phone_number">電話番号</label>
            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}" required>
        </div>
        <div class="form__text">
            <label for="image_url">画像URL</label>
            <input type="text" name="image_url" class="form-control" value="{{ old('image_url') }}">
        </div>
        <div class="form__text">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>
        <div class="form__text">
            <label for="area">エリア</label>
            <input type="text" name="area" class="form-control" value="{{ old('area') }}" required>
        </div>
        <div class="form__text">
            <label for="cuisine_type">料理の種類</label>
            <input type="text" name="cuisine_type" class="form-control" value="{{ old('cuisine_type') }}" required>
        </div>
        <button type="submit" class="form__button">作成</button>
    </form>
</div>
@endsection
