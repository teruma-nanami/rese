<!-- resources/views/customer/reservation/done.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
  <div class="thanks__inner">
    <p>ご予約ありがとうございます</p>
    <a href="{{ route('mypage.show') }}">マイページ</a>
  </div>
</div>
@endsection
