

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/script.js"></script>

</head>
<body>
    <header>
        <div class="header-menu">
        <h1><a href="/top"><img class="atlas-png" src="{{ asset('images/atlas.png') }}"></a></h1>
                <div class="nav-menu">
                <p class="p-username">{{ Auth::user()->username }}さん</p>
                    <p class="nav-btn"></p>
                    <ul class="nav-btn-ul">
                    <li class="nav-btn-li"><a href="/top">HOME</a></li>
                    <li class="nav-btn-li"><a href="/profile">プロフィール編集</a></li>
                    <li class="nav-btn-li"><a href="/logout">ログアウト</a></li>
                </ul>
                <p class="icon"><img src="{{ asset('storage/images/' . Auth::user()->images) }}" height="70px" width="70px"></p>
            </div>
            </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
            <div class="side-bar">
          
                <p class="side-name">{{ Auth::user()->username }}さんの</p>
                <div class="f-count">
                <p class="count">フォロー数</p>
                <p>{{  Auth::user()->follows()->count() }}名</p>
                </div>
                <p class="f-list-btn"><button type="submit" class="btn btn-primary"><a href="/follow-list">フォローリスト</a></button></p>

                <div class="fw-count">
                <p class="count">フォロワー数</p>
                <p>{{  Auth::user()->followers()->count() }}名</p>
                </div>
                <p class="fw-list-btn"><button type="submit" class="btn btn-primary"><a href="/follower-list">フォロワーリスト</a></button></p>

            <p class="list-search"><button type="submit" class="btn btn-primary"><a href='/search'>ユーザー検索</a></button></p>
            </div>
            </div>
    </div>
    <footer>
    </footer>
    <script src="JavaScriptファイルのURL"></script>
    <script src="JavaScriptファイルのURL"></script>
</body>
</html>

