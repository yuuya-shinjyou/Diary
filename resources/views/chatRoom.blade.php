@extends('layouts.default')

@section('link')
  <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
@endsection

@section('title', 'メッセージ')

@section('rightPanel')
  <div class="right-panel">

    @foreach ($messages as $message)
      @if ($message->user_id === Auth::user()->id)
      <div class="messageRight">
        <p>{{ \Carbon\Carbon::parse($message->created_at)->format('G:i'); }}</p>
        <div class="sender-right">
          <p>{{ $message->nickname }}</p>
          <p class="myBalloon">{{ $message->talk }}</p>
        </div>
        <div class="userIcon">
          <i class="fa-solid fa-user"></i>
        </div>
      </div>
      @else
      <div class="messageLeft">
        <div class="userIcon">
          <i class="fa-solid fa-user"></i>
        </div>
        <div class="sender-left">
          <p>{{ $message->nickname }}</p>
          <p class="otherBalloon">{{ $message->talk }}</p>
        </div>
        <p>{{ \Carbon\Carbon::parse($message->created_at)->format('G:i'); }}</p>
      </div>
      @endif
        
    @endforeach

  </div>
@endsection