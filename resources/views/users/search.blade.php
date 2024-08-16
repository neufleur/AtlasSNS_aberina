@extends('layouts.login')

@section('content')

<?php

try {
    if(isset($_POST["search"])){
    // 慣習としてPDOインスタンスはdbh(データベースハンドルの略)にする mysqlに繋げる
    $dbh = new PDO("mysql:dbname=atlas_sns; host=localhost; charset=utf8", "root" ,"root");
    $sql="SELECT username images FROM users";
    $stmt=$dbh->query($sql); //$sqlで定義されたSQL文がデータベースに送信され、実行の準備ができる
    $stmt->execute(); //実行
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // 結果セットに残っている全ての行を含む配列を返す　取得結果がゼロ件だった場合は空の配列を返す
}

  } catch(PDOException $e) { //エラーを出す
    echo $e -> getMessage(); //受け取る
  }

?>

<div id="search">
    <form action='/search' method="post"> <!--actionを変える -->
        @csrf
        <input type="text" name="keyword" placeholder="ユーザー名" value="{{$keyword}}" > <!--name="keyword"で入力されたものを入れる -->
        <button id="sbtn" type="submit"><img src="{{ asset('images/search.png') }}" >
        </button>
    </form>

</div>
<!-- 保存されているユーザー一覧 -->
<div class="container-list">

    <table class="table table-hover">
        @foreach ($users as $users)
        <!-- foreach 順番に取り出す($配列　as $値を入れる変数) -->
        <!-- 自分以外のユーザー表示 2つの値が異なるかどうかを確認　==　-->
        @if (!($users->username == $users->username))
        <tr>
            <td>{{ $users->username }}</td>
            <td><img src="{{ $users->images }}" alt="ユーザーアイコン"></td>
        </tr>
        @endif
        @endforeach
    </table>
</div>


@endsection

SELECT * FROM users WHERE username;