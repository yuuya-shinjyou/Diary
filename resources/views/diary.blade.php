@extends('layouts.default')

@section('link')
  <link href="{{ asset('css/diary.css') }}" rel="stylesheet">
  <link href="{{ asset('css/flashMessage.css') }}" rel="stylesheet">
@endsection

@section('title','日記帳')

@section('content')

  {{-- フラッシュメッセージ --}}
  @flash(success)
  @flash(failed)
  @flash(question)

  <div class="container">

    <div class="left-panel">
      <div class="left-panelTop">
        <i class="fa-solid fa-user"></i>
        <p class="userName">{{ Auth::user()->nickname }}</p>
      </div>

      <div class="left-panelMenu">
        <div class="menuTitle">Menu</div>

        <div class="menuItem">
          <div class="choosing">
            {{-- <input type="radio" id="myDiary" name="selectMenu"> --}}
          </div>
          <div class="test">
            <label for="myDiary">
              <a href="{{ route('diary.mylist') }}">
                <i class="fa-regular fa-comment"></i>
                自分の日記
              </a>
            </label>
          </div>
        </div>

        <div class="menuItem">
          <div class="choosing"></div>
          {{-- <input type="radio" id="timeLine" name="selectMenu"> --}}
          <label for="timeLine">
            <i class="fa-regular fa-comments"></i>
            <a href="{{ route('diary.timeline') }}">タイムライン</a>
          </label>
        </div>
        <div class="menuItem">
          <div class="choosing"></div>
          {{-- <input type="radio" id="option" name="selectMenu"> --}}
          <label for="option">
            <i class="fa-solid fa-gear"></i>
            <a href="#">設定</a>
          </label>
        </div>
        <div class="menuItem">
          <div class="choosing"></div>
          {{-- <input type="radio" id="update" name="selectMenu"> --}}
          <label for="update">
            <i class="fa-solid fa-rotate-right"></i>
            <a href="#">更新</a>
          </label>
        </div>
        <div class="menuItem">
          <div class="choosing"></div>
          {{-- <input type="radio" id="logout" name="selectMenu"> --}}
          <label for="logout">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <a href="{{ route('logOut') }}">ログアウト</a>
          </label>
        </div>
        <h2>Menu</h2>
        <ul>
          <li>Subject</li>
          <li>Subject</li>
          <li>Subject</li>
          <li>Subject</li>
          <li>Subject</li>
        </ul>
        <h2>Menu</h2>
        <ul>
          <li>Subject</li>
          <li>Subject</li>
          <li>Subject</li>
          <li>Subject</li>
          <li>Subject</li>
        </ul>
  
      </div>
    </div>

    <div class="right-panel">

      {{-- js --}}
      <div id="overlay"></div>
      <div id="Modal">
        <h1>表示</h1>
        <button id="closeModal" type="button">閉じる</button>
      </div>

      <button id="showModal" type="button">表示</button>

      
      <form action="{{ route('diary.search') }}" method="POST">
        @csrf
        <div class="menuItem">
          <input type="text" name="inputSearch" placeholder="検索..." value="{{ isset($search) ? $search:'' }}" maxlength="50">
          <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
      </form>

      @foreach ($blogs->groupBy(function($blog) {
        return \Carbon\Carbon::parse($blog->created_at)->format('n月d日');
      }) as $formattedDate => $groupedBlogs)
          <h2>{{ $formattedDate }}</h2>
      
          @foreach ($groupedBlogs as $blog)
              <div class="content-item">
                  <div class="item-header">
                      <div class="item-title">{{ $blog->title }}</div>
                      <div class="item-date">
                        <p class="item-weather">{{ $blog->created_at->format('H時i分') }}</p>
                        <p class="item-weather">{{ $blog->weather }}</p>
                        <div class="userName">
                            <p>{{ $blog->nickname }}</p>
                        </div>
                      </div>
                  </div>
                  <p>{!! nl2br($blog->body) !!}</p>
              </div>
          @endforeach
      
      @endforeach

      <div class="footer">
        <a href="#">お問い合わせはこちら</a>
      </div>

    </div>

  </div>

  {{-- 書き込みボタン(js) --}}
  <a href="{{ route('postScreen') }}" class="writeButton">
    <i class="fa-regular fa-pen-to-square"></i>
  </a>


@endsection

@section('javascript')
  <script>
    document.addEventListener("DOMContentLoaded", function() {

      if(document.querySelector(".flash-message")){
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
      }

    });

    const modal = document.getElementById("Modal");
    const overlay = document.getElementById("overlay");
    const showModal = document.getElementById("showModal");
    const closeModal = document.getElementById("closeModal");
    
    showModal.addEventListener("click", function () {
      modal.style.display = "block";
      overlay.style.display = "block";
    });

    closeModal.addEventListener("click", function () {
      modal.style.display = "none";
      overlay.style.display = "none";
    });

    // overlay.addEventListener("click", function () {
    //   modal.style.display = "none";
    //   overlay.style.display = "none";
    // });

  </script>  
@endsection