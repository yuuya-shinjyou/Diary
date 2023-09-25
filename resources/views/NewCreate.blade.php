<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://kit.fontawesome.com/5ee5f6d7f1.js" crossorigin="anonymous"></script>
  <title>新規登録</title>

  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/error.css') }}" rel="stylesheet">

</head>
<body>
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

</body>
</html>
