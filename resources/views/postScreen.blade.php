@extends('layouts.default')

@section('link')
  <link rel="stylesheet" href="{{ asset('css/postScreen.css') }}">
  <link rel="stylesheet" href="{{ asset('css/error.css') }}">
@endsection

@section('title','投稿画面')

@section('content')
  <p>Your ID: {{ Auth::user()->id }}</p> 
  <p>Your Nickname:{{ Auth::user()->nickname }}</p>

  @if ($errors->any())
    <div class="alert">
      <ul>
        @foreach ($errors->all() as $error)  
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="Container">
    <form action="{{ route('posted') }}" method="POST">
      @csrf
      <div class="date">
        <p>{{ \Carbon\Carbon::today()->isoformat("M月D日 (ddd)") }}</p>
      </div>

      <div class="weather">
        <input class="input-weather" type="radio" id="sun" name="weather" value="sun" {{ old('weather') === 'sun' ? 'checked':'' }}>
        <label for="sun">晴れ</label>
        <input class="input-weather" type="radio" id="cloudy" name="weather" value="cloudy" {{ old('weather') === 'cloudy' ? 'checked':'' }}>
        <label for="cloudy">曇り</label>
        <input class="input-weather" type="radio" id="rain" name="weather" value="rain" {{ old('weather') === 'rain' ? 'checked':'' }}>
        <label for="rain">雨</label>
      </div> 

      <div class="title">
        <label for="title">タイトル</label>
        <input type="text" id="title" name="title">  
      </div>

      <div class="body">
        <label for="body">投稿内容</label>
        <textarea name="body" id="body" cols="30" rows="10"></textarea>
      </div>

      <button type="submit">投稿</button>

    </form>
  </div>

@endsection
@section('javascript')

@endsection