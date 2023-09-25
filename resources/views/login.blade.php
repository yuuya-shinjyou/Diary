<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://kit.fontawesome.com/5ee5f6d7f1.js" crossorigin="anonymous"></script>
  <title>ログイン</title>

  <link href="{{ asset('css/login.css') }}" rel="stylesheet">
  <link href="{{ asset('css/flashMessage.css') }}" rel="stylesheet">
  <link href="{{ asset('css/error.css') }}" rel="stylesheet">

</head>
<body>
  {{-- フラッシュメッセージ --}}
  @flash(success)
  @flash(failed)
  @flash(question)

  @if (session('timeOut'))
      <div class="alert timeout">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        <p>長時間操作がなかった為タイムアウトしました</p>
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
    <form action="{{ route('login.loggedIn') }}" method="POST">
      @csrf
      <div class="id">
        <p class="label-id">ログインID</p>
        <input class="text-id" type="text" name="id" placeholder="user@example.com" value="{{ old('id') }}">
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

</body>
</html>
