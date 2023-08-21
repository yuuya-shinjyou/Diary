@extends('layouts.default')

@section('link')
  <link href="{{ asset('css/login.css') }}" rel="stylesheet">
  <link href="{{ asset('css/flashMessage.css') }}" rel="stylesheet">
  <link href="{{ asset('css/error.css') }}" rel="stylesheet">
@endsection
@section('title','ログイン')
@section('content')

  {{-- フラッシュメッセージ --}}
  @if (session('success'))
    <div class="flash-message success">
      <i class="fa-solid fa-check"></i>
      <p>{{ session('success') }}</p>
    </div>
  @elseif (session('failed'))
    <div class="flash-message failed">
      <i class="fa-solid fa-xmark"></i>
      <p>{{ session('failed') }}</p>
    </div>
  @elseif (session('question'))
    <div class="flash-message question">
      <i class="fa-solid fa-question"></i>
      <p>{{ session('question') }}</p>
    </div>
  @endif

  <div id="form">
    @if ($errors->any())
      <div class="alert">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <p class="login-log">Login</p>
    <form action="{{ route('user.loggedIn') }}" method="POST">
      @csrf
      <div class="id">
        <p class="label-id">ログインID</p>
        <input class="text-id" type="text" name="id" placeholder="user@example.com">
      </div>

      <div class="pass">
        <p class="label-pass">Password</p>
        <input class="text-pass" type="password" name="password">
      </div>

      <div class="submit">
        <button class="button-login" type="submit">ログイン</button>
      </div>

    </form>
  </div>
  <div class="div-create">
    <a class="a-create" href="newcreate">新規作成</a>
  </div>
@endsection

@section('javascript')
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        // フラッシュメッセージを取得
        const flashMessage = document.querySelector(".flash-message");

        // クラスを後付け
        setTimeout(function() {
          flashMessage.classList.add("fadeOut");
        }, 4000);

        // アニメーションが完了したらイベント開始
        flashMessage.addEventListener("animationend", function() {
          flashMessage.remove();
        });
    });
  </script>  
@endsection
