@extends('layouts.default')

@section('link')
  <link rel="stylesheet" href="{{ asset('css/postScreen.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endsection

@section('title','投稿画面')

@section('content')
  <p>Your ID: {{ Auth::user()->id }}</p> 
  <p>Your Nickname:{{ Auth::user()->nickname }}</p>

  <div class="Container">
    <form action="#" method="POST">
      @csrf
      <div class="calendar">
        <i class="fa-regular fa-calendar-days" id="flatpickr"></i>
        <p>{{ \Carbon\Carbon::today()->isoformat("M月D日 (ddd)") }}</p>
      </div>
      <div class="formcontainer">
        <div class="title">
          <label for="title">投稿内容</label>
          <input type="text" id="title" name="title">  
        </div>
        
        <div class="wether">
          <input class="input-wether" type="radio" id="sun" name="wether" value="sun" {{ old('wether') === 'sun' ? 'checked':'' }}>
          <label for="sun">晴れ</label>
          <input class="input-wether" type="radio" id="cloudy" name="wether" value="cloudy" {{ old('wether') === 'cloudy' ? 'checked':'' }}>
          <label for="cloudy">曇り</label>
          <input class="input-wether" type="radio" id="rain" name="wether" value="rain" {{ old('wether') === 'rain' ? 'checked':'' }}>
          <label for="rain">雨</label>
        </div> 

        <div class="body">
          <textarea name="body" id="body" cols="30" rows="10">
            
          </textarea>
        </div>
      </div>
      
    </form>
  </div>

@endsection
@section('javascript')
  <script>
    flatpickr('#flatpickr');
  </script>
@endsection