@extends('layouts.default')

@section('link')
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection
@section('title','新規作成')
@section('content')

  <h1 class="h1-title">新規登録</h1>

  <div class="form-container">
    <div class="div-form">
      <div class="row-container">
        <div class="left-container">
          <label for="nickname">ニックネーム :</label>
        </div>
        <div class="right-container">
          <input class="input-text" id="nickname" type="text">
        </div>
      </div>
      <div class="row-container">
        <div class="left-container">
          <label>性別 :</label>
        </div>
        <div class="right-container">
          <div class="gender-button">
            <input class="input-gender" type="radio" id="male" name="gender" value="male" required>
            <label for="male">男性</label>
            <input class="input-gender" type="radio" id="female" name="gender" value="female" required>
            <label for="female">女性</label>
            <input class="input-gender" type="radio" id="other" name="gender" value="other" required>
            <label for="other">その他</label>
          </div>
        </div>
      </div>
      <div class="row-container">
        <div class="left-container">
          <label for="avatar">アイコン画像 :</label>
        </div>
        <div class="right-container">
          <input type="file" id="avatar" accept=".jpg, .jpeg, .png"> 
        </div>
      </div>
      <div class="row-container">
        <div class="left-container">
          <label for="todohuken">都道府県 :</label>
        </div>
        <div class="right-container">
          <select name="todohuken" id="todohuken">
            <option value="" selected>都道府県</option>
            <optgroup label="北海道">
              <option value="北海道">北海道</option>
              <optgroup label="東北">
              <option value="青森県">青森県</option>
              <option value="岩手県">岩手県</option>
              <option value="宮城県">宮城県</option>
              <option value="秋田県">秋田県</option>
              <option value="山形県">山形県</option>
              <option value="福島県">福島県</option>
            <optgroup label="関東">
              <option value="茨城県">茨城県</option>
              <option value="栃木県">栃木県</option>
              <option value="群馬県">群馬県</option>
              <option value="埼玉県">埼玉県</option>
              <option value="千葉県">千葉県</option>
              <option value="東京都">東京都</option>
              <option value="神奈川県">神奈川県</option>
            <optgroup label="中部">
              <option value="新潟県">新潟県</option>
              <option value="富山県">富山県</option>
              <option value="石川県">石川県</option>
              <option value="福井県">福井県</option>
              <option value="山梨県">山梨県</option>
              <option value="長野県">長野県</option>
              <option value="岐阜県">岐阜県</option>
              <option value="静岡県">静岡県</option>
              <option value="愛知県">愛知県</option>
            <optgroup label="近畿">
              <option value="三重県">三重県</option>
              <option value="滋賀県">滋賀県</option>
              <option value="京都府">京都府</option>
              <option value="大阪府">大阪府</option>
              <option value="兵庫県">兵庫県</option>
              <option value="奈良県">奈良県</option>
              <option value="和歌山県">和歌山県</option>
            <optgroup label="中国">
              <option value="鳥取県">鳥取県</option>
              <option value="島根県">島根県</option>
              <option value="岡山県">岡山県</option>
              <option value="広島県">広島県</option>
              <option value="山口県">山口県</option>
            <optgroup label="四国">
              <option value="徳島県">徳島県</option>
              <option value="香川県">香川県</option>
              <option value="愛媛県">愛媛県</option>
              <option value="高知県">高知県</option>
            <optgroup label="九州・沖縄">
              <option value="福岡県">福岡県</option>
              <option value="佐賀県">佐賀県</option>
              <option value="長崎県">長崎県</option>
              <option value="熊本県">熊本県</option>
              <option value="大分県">大分県</option>
              <option value="宮崎県">宮崎県</option>
              <option value="鹿児島県">鹿児島県</option>
              <option value="沖縄県">沖縄県</option>
            </optgroup>
          </select>
        </div>
      </div>
      <div class="row-container">
        <div class="left-container">
          <label>公開設定 :</label>
        </div>
        <div class="right-container">
          <div class="publishing-button">
            <input class="input-publishing" type="radio" id="public" name="publishing" value="public" required>
            <label for="public">公開</label>
            <input class="input-publishing" type="radio" id="private" name="publishing" value="private" required>
            <label for="private">非公開</label>
          </div>
        </div>
      </div>
      <div class="row-container">
        <div class="left-container">
          <label for="email">メールアドレス :</label>
        </div>
        <div class="right-container">
          <input class="input-text" id="email" type="email">
        </div>
      </div>
      <div class="row-container">
        <div class="left-container">
          <label for="password">パスワード :</label>
        </div>
        <div class="right-container">
          <input class="input-pass" type="password" id="password">
        </div>
      </div>

      <div class="div-send">
        <input class="button-send" type="submit" value="登録">
      </div>
    </div>
  </div>


@endsection