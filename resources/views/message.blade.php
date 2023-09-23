@extends('layouts.default')

@section('link')
  <link rel="stylesheet" href="{{ asset('css/message.css') }}">
@endsection

@section('title', 'メッセージ')

@section('rightPanel')
  <div class="right-panel">

    
  @foreach ($talkRoom as $room)
    <a href="{{ route('message.chat', ['roomId' => $room->room_id]) }}" class="message-bar">
      <p>{{ $room->room_id }}</p>
      <div class="userIcon">
        <i class="fa-solid fa-user"></i>
      </div>
      <div class="talkData">
        <p class="userName">{{ $room->room_name }}</p>
        @if (Str::length($room->talk)>20)
          <p class="talk">{{ Str::substr($room->talk, 0, 20) . '...'  }}</p>
        @else
          <p class="talk">{{ is_null($room->talk) ? 'まだメッセージがありません' : $room->talk }}</p>  
        @endif
      </div>
    </a>
  @endforeach

  </div>
  
@endsection