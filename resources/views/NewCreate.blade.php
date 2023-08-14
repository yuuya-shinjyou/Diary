@extends('layouts.default')

@section('link')
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection
@section('title','新規作成')
@section('content')

  <h1 class="h1-title">新規登録</h1>

  <form action="{{ route('admin.user.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-container">
      @if ($errors->any())
          <div class="alert">
            <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
      @endif
      <div class="div-form">
        <div class="row-container">
          <div class="left-container">
            <label for="nickname">ニックネーム :</label>
          </div>
          <div class="right-container">
            <input class="input-text" id="nickname" name="nickname" type="text" value="{{ old('nickname') }}">
          </div>
        </div>
        <div class="row-container">
          <div class="left-container">
            <label>性別 :</label>
          </div>
          <div class="right-container">
            <div class="gender-button">
              <input class="input-gender" type="radio" id="male" name="gender" value="male" {{ old('gender') === 'male' ? 'checked':'' }}>
              <label for="male">男性</label>
              <input class="input-gender" type="radio" id="female" name="gender" value="female" {{ old('gender') === 'female' ? 'checked':'' }}>
              <label for="female">女性</label>
              <input class="input-gender" type="radio" id="other" name="gender" value="other" {{ old('gender') === 'other' ? 'checked':'' }}>
              <label for="other">その他</label>
            </div>
          </div>
        </div>
        <div class="row-container">
          <div class="left-container">
            <label for="avatar">アイコン画像 :</label>
          </div>
          <div class="right-container">
            <input type="file" id="avatar" name="avatar" accept=".jpg, .jpeg, .png"> 
          </div>
        </div>
        <div class="row-container">
          <div class="left-container">
            <label for="todohuken">都道府県 :</label>
          </div>
          <div class="right-container">
            <select name="todohuken" id="todohuken">
              <option value="" {{ old('todohuken') === '' ? 'selected' : '' }}>都道府県</option>
              @foreach ($areas as $area => $prefectures)
                  <optgroup label="{{ $area }}">
                      @foreach ($prefectures as $prefecture)
                          <option value="{{ $prefecture }}" {{ old('todohuken') === $prefecture ? 'selected' : '' }}>{{ $prefecture }}</option>
                      @endforeach
                  </optgroup>
              @endforeach
              {{-- <optgroup label="北海道">
                <option value="北海道" {{ old('todohuken') === '北海道' ? 'selected' : '' }}>北海道</option>
              </optgroup>
              <optgroup label="東北">
                <option value="青森県" {{ old('todohuken') === '青森県' ? 'selected' : '' }}>青森県</option>
                <option value="岩手県" {{ old('todohuken') === '岩手県' ? 'selected' : '' }}>岩手県</option>
                <option value="宮城県" {{ old('todohuken') === '宮城県' ? 'selected' : '' }}>宮城県</option>
                <option value="秋田県" {{ old('todohuken') === '秋田県' ? 'selected' : '' }}>秋田県</option>
                <option value="山形県" {{ old('todohuken') === '山形県' ? 'selected' : '' }}>山形県</option>
                <option value="福島県" {{ old('todohuken') === '福島県' ? 'selected' : '' }}>福島県</option>
              </optgroup>
              <optgroup label="関東">
                <option value="茨城県" {{ old('todohuken') === '茨城県' ? 'selected' : '' }}>茨城県</option>
                <option value="栃木県" {{ old('todohuken') === '栃木県' ? 'selected' : '' }}>栃木県</option>
                <option value="群馬県" {{ old('todohuken') === '群馬県' ? 'selected' : '' }}>群馬県</option>
                <option value="埼玉県" {{ old('todohuken') === '埼玉県' ? 'selected' : '' }}>埼玉県</option>
                <option value="千葉県" {{ old('todohuken') === '千葉県' ? 'selected' : '' }}>千葉県</option>
                <option value="東京都" {{ old('todohuken') === '東京都' ? 'selected' : '' }}>東京都</option>
                <option value="神奈川県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>神奈川県</option>
              <optgroup label="中部">
                <option value="新潟県" {{ old('todohuken') === '新潟県' ? 'selected' : '' }}>新潟県</option>
                <option value="富山県" {{ old('todohuken') === '富山県' ? 'selected' : '' }}>富山県</option>
                <option value="石川県" {{ old('todohuken') === '石川県' ? 'selected' : '' }}>石川県</option>
                <option value="福井県" {{ old('todohuken') === '福井県' ? 'selected' : '' }}>福井県</option>
                <option value="山梨県" {{ old('todohuken') === '山梨県' ? 'selected' : '' }}>山梨県</option>
                <option value="長野県" {{ old('todohuken') === '長野県' ? 'selected' : '' }}>長野県</option>
                <option value="岐阜県" {{ old('todohuken') === '岐阜県' ? 'selected' : '' }}>岐阜県</option>
                <option value="静岡県" {{ old('todohuken') === '静岡県' ? 'selected' : '' }}>静岡県</option>
                <option value="愛知県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>愛知県</option>
              <optgroup label="近畿">
                <option value="三重県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>三重県</option>
                <option value="滋賀県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>滋賀県</option>
                <option value="京都府" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>京都府</option>
                <option value="大阪府" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>大阪府</option>
                <option value="兵庫県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>兵庫県</option>
                <option value="奈良県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>奈良県</option>
                <option value="和歌山県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>和歌山県</option>
              <optgroup label="中国">
                <option value="鳥取県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>鳥取県</option>
                <option value="島根県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>島根県</option>
                <option value="岡山県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>岡山県</option>
                <option value="広島県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>広島県</option>
                <option value="山口県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>山口県</option>
              <optgroup label="四国">
                <option value="徳島県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>徳島県</option>
                <option value="香川県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>香川県</option>
                <option value="愛媛県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>愛媛県</option>
                <option value="高知県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>高知県</option>
              <optgroup label="九州・沖縄">
                <option value="福岡県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>福岡県</option>
                <option value="佐賀県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>佐賀県</option>
                <option value="長崎県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>長崎県</option>
                <option value="熊本県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>熊本県</option>
                <option value="大分県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>大分県</option>
                <option value="宮崎県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>宮崎県</option>
                <option value="鹿児島県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>鹿児島県</option>
                <option value="沖縄県" {{ old('todohuken') === '神奈川県' ? 'selected' : '' }}>沖縄県</option>
              </optgroup> --}}
            </select>
          </div>
        </div>
        <div class="row-container">
          <div class="left-container">
            <label>公開設定 :</label>
          </div>
          <div class="right-container">
            <div class="publishing-button">
              <input class="input-publishing" type="radio" id="public" name="publishing" value="public" {{ old('publishing') === 'public' ? 'checked':'' }}>
              <label for="public">公開</label>
              <input class="input-publishing" type="radio" id="private" name="publishing" value="private" {{ old('publishing') === 'private' ? 'checked':'' }}>
              <label for="private">非公開</label>
            </div>
          </div>
        </div>
        <div class="row-container">
          <div class="left-container">
            <label for="email">メールアドレス :</label>
          </div>
          <div class="right-container">
            <input class="input-text" id="email" name="email" type="email" value="{{ old('email') }}">
          </div>
        </div>
        <div class="row-container">
          <div class="left-container">
            <label for="password">パスワード :</label>
          </div>
          <div class="right-container">
            <input class="input-pass" type="password" name="password" id="password">
          </div>
        </div>

        <div class="div-send">
          <input class="button-send" type="submit" value="登録">
        </div>
      </div>
    </div>
  </form>

@endsection