@extends('layouts.admin')

@section('content')
  <div class="container">
    <h1>CSVファイルのインポート</h1>
    <form action="{{ route('import.process') }}" method="POST" enctype="multipart/form-data" class="form">
      @csrf
      <div class="form__text">
        <label for="csv_file">CSVファイルを選択:</label>
        <input type="file" name="csv_file" required>
      </div>
      <button type="submit" class="form__button">インポート</button>
    </form>

  </div>
@endsection
