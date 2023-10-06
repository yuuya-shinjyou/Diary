@extends('layouts.default')

@section('link')
  <link href="{{ asset('css/message.css') }}" rel="stylesheet">
  <link href="{{ asset('css/diary.css') }}" rel="stylesheet">
  <link href="{{ asset('css/createChatRoom.css') }}" rel="stylesheet">
@endsection

@section('title', 'メッセージ')

@section('rightPanel')

@flash(success)

  <div class="right-panel">

    <button class="createRoom" id="switching">
      <p>グループチャット作成</p>
      <i class="fa-solid fa-plus"></i>
    </button>

    @foreach ($talkRoom as $room)
      <a href="{{ route('message.chat', ['roomId' => $room->room_id]) }}" class="message-bar">
        <p>{{ $room->room_id }}</p>
        
        @if ($room->class === 2)
          <div class="userIcon">
            <i class="fa-solid fa-users"></i>
          </div>
        @else
          <div class="userIcon">
            <i class="fa-solid fa-user"></i>
          </div>
        @endif
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

  {{-- モーダル --}}
  <div id="modal" class="postPanel showFlag">
    <div class="overlay"></div>
    
    <div class="Modal" id="modal-panel">
    
      @if ($errors->any())
        <div id="alert" class="alert">
          <ul>
            @foreach ($errors->all() as $error)  
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
    
      <div class="Container">
        <form action="{{ route('message.createGroup') }}" method="POST">
          @csrf
    
          <div class="data-title">
            <label for="title">ルーム名：</label>
            <input class="titleInput" type="text" id="title" name="title" placeholder="ルーム名" value="{{ old('title') }}">  
          </div>

          <div class="data-body">
            <label>メンバー：</label>

            <div class="friendList" id="list">
              @foreach ($friends as $friend)
                <div class="friend">
                  @if (is_null($friend->avatar))
                    <i class="fa-solid fa-user"></i>
                  @else
                    {{ $friend->avatar }}
                  @endif
                  <label for="{{ $friend->id }}">{{ $friend->nickname }}</label>
                  <input type="checkbox" id="{{ $friend->id }}" name="members[]" value="{{ $friend->id }}">  
                </div>
              @endforeach
            </div>
          </div>
          
          <div class="modal-button">
            <button class="buttonPost" type="submit">作成</button>
          </div>

          <button id="closeModal" class="close" type="button">
            <i class="fa-solid fa-xmark"></i>
          </button>

        </form>


  
      </div>
    
    </div>
  </div>

  
@endsection

@section('javascript')
  <script>
    const modal = document. getElementById("modal");
    const switching = document.getElementById("switching");
    const showModal = document.getElementById("showModal");
    const closeModal = document.getElementById("closeModal");
    
    switching.addEventListener("click", function () {
        modal.classList.remove("showFlag");
    });

    closeModal.addEventListener("click", function () {
        modal.classList.add("showFlag");
    });

    if(document.getElementById('alert') != null){
      modal.classList.remove('showFlag');
    }

    // モーダルの高さ設定
    document.addEventListener('DOMContentLoaded', function() {
      const Modal = document.getElementById('modal-panel');
      Modal.style.maxHeight = (window.innerHeight - 40) + "px";

      const friendList = document.getElementById('list');
      friendList.style.maxHeight = (window.innerHeight * 0.5) + 'px';
    });

  </script>
@endsection