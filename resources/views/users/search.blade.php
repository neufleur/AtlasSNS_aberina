@extends('layouts.login')

@section('content')


<div id="/search">
    <form action='/search' method="post"> <!--actionを変える -->
        @csrf
        <input type="text" name="keyword" placeholder="ユーザー名" >
         @if(!empty($keyword))
        <div class="alert alert-primary">{{$keyword}}</div>
        <!--name="keyword"で入力されたものを入れる -->
        @endif
        <button id="sbtn" type="submit"><img class="search-png" src="{{ asset('images/search.png') }}" ></button>
    </form>
</div>
<!-- 保存されているユーザー一覧 -->
<div class="container-list">

    <table class="search-table table-hover">
        @foreach ($users as $users)
        <!-- foreach 順番に取り出す($配列　as $値を入れる変数) -->
        <!-- 今自分がログインしているユーザー　==　他の人がログインしているユーザー 2つの値が異なるかどうかを確認　-->
        @if (!(Auth::user()->username == $users->username))
        <tr>
        <td><img src="{{ asset('storage/images/' . $users->images) }}"></td>
            <td>{{ $users->username }}</td>

         <!-- フォローするフォロー解除ボタン機能 user.phpからの取得-->
        @if(auth()->user()->isFollowing($users->id))

        <!--ログインしているユーザー　フォローするデータ送る  -->
        <form action="{{ route('unfollow', ['id' => $users->id]) }}" method="post">  <!-- フォロー解除-->
          <td><button type="submit" id="ff" class="btn btn-danger">フォロー解除</button></td>
        </form>
        @else
        <form action="{{ route('follow', ['id' => $users->id]) }}"  method="post"><!-- フォローする-->
        @csrf
        <td><button type="submit" id="ff" class="btn btn-primary">フォローする</button></td>
        </form>

          @endif
        </tr>
        @endif
        @endforeach
    </table>
</div>

 @endsection
