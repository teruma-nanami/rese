<!-- resources/views/customer/reservation/done.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>予約が完了しました</h1>
    <p>ご予約ありがとうございます。予約内容の確認はマイページから行えます。</p>
    <a href="{{ route('mypage.show') }}" class="btn btn-primary">マイページへ</a>
</div>
@endsection
