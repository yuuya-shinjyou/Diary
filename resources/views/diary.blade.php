@extends('layouts.default')

@section('link')
  <link href="{{ asset('css/diary.css') }}" rel="stylesheet">  
@endsection

@section('title','日記帳')

@section('rightPanel')

  @flash(success)
  @flash(failed)
  @flash(question)

  <div class="right-panel">

    {{-- js --}}
    <div id="modal" class="postPanel showFlag">
      <div class="overlay"></div>
      
      <div class="Modal">
      
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
          <form action="{{ route('diary.post') }}" method="POST">
            @csrf

            <div class="data">
              <div class="date">
                <p>{{ \Carbon\Carbon::today()->isoformat("M月D日 (ddd)") }}</p>
              </div>

              <div id="weather" class="weather">
                <input class="input-weather" type="radio" id="sun" name="weather" value="sun" {{ old('weather') === 'sun' ? 'checked':'' }}>
                <label for="sun">
                  <i class="ai-sun-fill"></i>
                  <p>晴れ</p>
                </label>

                <input class="input-weather" type="radio" id="cloudy" name="weather" value="cloudy" {{ old('weather') === 'cloudy' ? 'checked':'' }}>
                <label for="cloudy">
                  <i class="fa-solid fa-cloud"></i>
                  <p>曇り</p>
                </label>

                <input class="input-weather" type="radio" id="rain" name="weather" value="rain" {{ old('weather') === 'rain' ? 'checked':'' }}>
                <label for="rain">
                  <i class="fa-solid fa-umbrella"></i>
                  <p>雨</p>
                </label>

              </div>

            </div>
      
            <div class="data-title">
              <label for="title">タイトル：</label>
              <input class="titleInput" type="text" id="title" name="title" placeholder="タイトル" value="{{ old('title') }}">  
            </div>

            <div class="data-body">
              <label for="body">投稿内容：</label>
              <textarea class="bodyInput" name="body" id="body" cols="40" rows="12" placeholder="本文...">{{ old('body') }}</textarea>  
            </div>

            <div class="modal-button">
              <button id="reset" class="buttonReset" type="button">リセット</button>
              <button class="buttonPost" type="submit">投稿</button>
            </div>
      
          </form>
        </div>
      
      </div>
    </div>
    
    {{-- メインパネル --}}
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

                      @switch($blog->weather)
                        @case("sun")
                          <p class="item-weather"><i class="ai-sun-fill"></i></p>                              
                          @break
                        @case("cloudy")
                          <p class="item-weather"><i class="fa-solid fa-cloud"></i></p>
                          @break
                        @case("rain")
                          <p class="item-weather"><i class="fa-solid fa-umbrella"></i></p>                          
                          @break
                        @default
                        <p class="item-weather"><i class="fa-solid fa-question"></i></p>
                      @endswitch
                      
                      <p class="item-weather">{{ $blog->created_at->format('H時i分') }}</p>

                      @if (Auth::user()->id === $blog->AccountNum)
                        <div class="userName">
                          <p>{{ $blog->nickname }}</p>
                        </div>
                      @else
                        <div class="userName">
                          <a href="{{ route('message.contact', ['partner' => $blog->AccountNum]) }}">{{ $blog->nickname }}</a>
                        </div>
                      @endif

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

  {{-- 書き込みボタン(js) --}}
  <div id="switching" class="writeButton">
    <i id="showModal" class="fa-regular fa-pen-to-square"></i>
    <i id="closeModal" class="fa-solid fa-xmark"></i>
  </div>

@endsection

@section('javascript')
  
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

    // モーダル表示・非表示 処理
    const modal = document. getElementById("modal");
    const switching = document.getElementById("switching");
    const showModal = document.getElementById("showModal");
    const closeModal = document.getElementById("closeModal");
    
    switching.addEventListener("click", function () {
      if (modal.classList.contains('showFlag')) {
        modal.classList.remove("showFlag");

        showModal.style.display = "none";
        closeModal.style.display = "block";

      } else {
        modal.classList.add("showFlag");

        showModal.style.display = "block";
        closeModal.style.display = "none";

      }
    });


    // 投稿エラー検出 処理
    if(document.getElementById("alert") != null){
      modal.classList.remove("showFlag");

      showModal.style.display = "none";
      closeModal.style.display = "block";
    }

    // リセットボタン
    const reset = document.getElementById("reset");
    const bodyText = document.getElementById('body');
    const titleText = document.getElementById('title');
    const radioButton = document.getElementById('weather').getElementsByTagName('input');
    
    reset.addEventListener('click', function() {
      for (let i = 0; i < radioButton.length; i++) {
        radioButton[i].checked = false;
      } 
      titleText.value = "";
      bodyText.value = "";
    });

  </script>  
@endsection