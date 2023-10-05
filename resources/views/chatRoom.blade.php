@extends('layouts.default')

@section('link')
  <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
@endsection

@section('title', 'メッセージ')

@section('rightPanel')
  <div class="right-panel" id="scroll-down">
    
    <div class="panel">

      <div class="chatData">
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

      <div class="message-container">
        <form action="{{ route('message.send', ['roomId' => $roomId]) }}" method="POST" id="messageForm">
          @csrf
          <div class="input-field">
            <textarea name="messageText" class="message-input" id="inputText" cols="30" rows="1" placeholder="メッセージを入力" autocomplete="off"></textarea>
            <button id="sendIcon" class="message-send" type="submit">
              <span class="fa-regular fa-paper-plane"></span>
            </button>
          </div>
        </form>
      </div>

    </div>

  </div>

  <script>
    const sendIcon = document.getElementById("sendIcon");
    const inputText = document.getElementById('inputText');

    inputText.addEventListener('input', setTextareaHeight);
    function setTextareaHeight(){
        this.style.height = 'auto';
        this.style.height = `${this.scrollHeight}px`;
    }

    inputText.addEventListener("input", function(){
      if(inputText.value.replace(/\r?\n/g, '').length > 0){
        sendIcon.classList.add('possible');
      } else {
        sendIcon.classList.remove('possible');
      }
    });

    const scroll = document.getElementById('scroll-down');
    scroll.scrollIntoView(false);

  </script>

@endsection