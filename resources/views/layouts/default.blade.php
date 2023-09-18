<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/modern-css-reset/dist/reset.min.css"/>
  <script src="https://kit.fontawesome.com/5ee5f6d7f1.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/akar-icons-fonts"></script>
  
  <link href="{{ asset('css/flashMessage.css') }}" rel="stylesheet">
  <link href="{{ asset('css/error.css') }}" rel="stylesheet">
  <link href="{{ asset('css/leftPanel.css') }}" rel="stylesheet">
  @yield('link')
  <title>@yield('title')</title>
</head>
<body>
  <div class="container">

    <div class="left-panel">
      <div class="left-panelTop">
        <i class="fa-solid fa-user"></i>
        <p class="userName">{{ Auth::user()->nickname }}</p>
      </div>

      <div class="left-panelMenu">
        <div class="menuTitle">Menu</div>

        <div class="menuItem">
          <div class="choosing"></div>
          <input type="radio" id="myDiary" name="selectMenu">
          <label for="myDiary">
            <i class="fa-regular fa-comment"></i>
            <a href="{{ route('diary.mylist') }}">自分の日記</a>
          </label>
        </div>

        <div class="menuItem">
          <div class="choosing"></div>
          <input type="radio" id="timeLine" name="selectMenu">
          <label for="timeLine">
            <i class="fa-regular fa-comments"></i>
            <a href="{{ route('diary.timeline') }}">タイムライン</a>
          </label>
        </div>
        <div class="menuItem">
          <div class="choosing"></div>
          <input type="radio" id="option" name="selectMenu">
          <label for="option">
            <i class="fa-solid fa-gear"></i>
            <a href="#">設定</a>
          </label>
        </div>
        <div class="menuItem">
          <div class="choosing"></div>
          <input type="radio" id="update" name="selectMenu">
          <label for="update">
            <i class="fa-solid fa-rotate-right"></i>
            <a href="#">更新</a>
          </label>
        </div>
        <div class="menuItem">
          <div class="choosing"></div>
          <input type="radio" id="message" name="selectMenu">
          <label for="message">
            <i class="fa-regular fa-envelope"></i>
            <a href="{{ route('message.message') }}">メッセージ</a>
          </label>
        </div>
        <div class="menuItem">
          <div class="choosing"></div>
          <input type="radio" id="logout" name="selectMenu">
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

    {{-- メインパネル --}}
    @yield('rightPanel')

  </div>

  <script>
    // フラッシュメッセージ処理

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

  </script> 

  @yield('javascript')

</body>
</html>