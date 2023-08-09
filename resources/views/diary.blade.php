@extends('layouts.default')

@section('link')
  <link href="{{ asset('css/diary.css') }}" rel="stylesheet">
@endsection

@section('title','日記帳')

@section('content')

  <header>
    <div class="header-a">
      <a href="#">自分の日記</a>
    </div>
    <div class="header-a">
      <a href="#">タイムライン</a>
    </div>
    <div class="header-a">
      <a href="#">検索</a>
    </div>
    <div class="header-a">
      <a href="#">設定</a>
    </div>
    <div class="header-a">
      <a href="#">更新</a>
    </div>
    <div class="right-align">
      <p class="header-account">アカウント名</p>
    </div>
  </header>

  <main>
    <div class="main-container">
       @for($i=1; $i<=5; $i++) {{-- データの分だけ表示 --}}
        <div class="content-item">
          <div class="item-header">
            <div class="item-date">8月8日（火）</div>
            <div class="right-align">
              <p class="item-weather">晴れ</p>
            </div>
          </div>
          <p>日記の書き込み内容日記の書き込み内容日記の書き込み内容日記の書き込み内容日記の書き込み内容日記の書き込み内容日記の書き込み内容日記の書き込み内容日記の書き込み内容日記の書き込み内容日記の書き込み内容日記の書き込み内容日記の書き込み内容日記の書き込み内容日記の書き込み内容</p>
        </div>
      @endfor
    </div>
    <div class="side-container">
      <div class="content-item">
        <div class="item-header">
          <div class="item-carender">カレンダー</div>
        </div>
        <p>1月2月3月</p>
      </div>

      <div class="content-item">
        <div class="item-header">
          <div class="item-hash">ハッシュタグ</div>
        </div>
        <p>#############################</p>
      </div>
    </div>
  </main>

  <footer>
    <a href="#">お問い合わせはこちら</a>
  </footer>

@endsection