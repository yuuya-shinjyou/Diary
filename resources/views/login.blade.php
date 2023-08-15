@extends('layouts.default')

@section('link')
  <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endsection
@section('title','ログイン')
@section('content')

  {{-- フラッシュメッセージ --}}
  {{-- @if (session('success'))
    <div class="msg-success">
      {{ session('success') }}
    </div>
  @endif --}}
  <div class="msg success">
    <i class="fa-solid fa-check"></i>
    <p>登録が完了しました</p>
  </div>

  <div id="form">
    <p class="Login-Logo">Login</p>
    <form action="diary" method="POST">
      @csrf
      <div class="id">
        <p class="label-id">ログインID</p>
        <input class="text-id" type="text" name="id">
      </div>

      <div class="pass">
        <p class="label-pass">Password</p>
        <input class="text-pass" type="password" name="pass">
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
