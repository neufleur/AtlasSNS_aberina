@extends('layouts.login')

@section('content')


<div id="/search">
    <form action='/search' method="post"> <!--actionを変える -->
        @csrf
        <div class="search-text">
        <input type="text" name="keyword" class="input" placeholder="ユーザー名" >
         @if(!empty($keyword))
        <div class="alert alert-primary">{{$keyword}}</div>
        <!--name="keyword"で入力されたものを入れる -->
        @endif
     <button class="search-png"><img class="search-png" src="{{ asset('images/search.png') }}" ></button>
        </div>
    </form>
</div>
<!-- 保存されているユーザー一覧 -->
<div class="container-list">

    <table class="search-table table-hover">
        @foreach ($users as $user)
        <!-- foreach 順番に取り出す($配列　as $値を入れる変数(単数)) -->
        <!-- 今自分がログインしているユーザー　==　他の人がログインしているユーザー 2つの値が異なるかどうかを確認　-->
        @if (!(Auth::user()->username == $user->username))
        <div class="search-user">
        <tr>
        <td><img src="{{ asset('storage/images/' . $user->images) }}" width="110px" height="110px"></td>
         <td><div class="search-name">{{ $user->username }}</div></td>

         <!-- フォローするフォロー解除ボタン機能 user.phpからの取得-->
        @if(auth()->user()->isFollowing($user->id))

        <!--ログインしているユーザー　フォローするデータ送る  -->
        <!-- ['user' => $user->id]) 'user'はコントローラーのpublic function Follow(User $user) 同じ関数-->
        <form action="{{ route('unFollow', ['user' => $user->id]) }}" method="post">
        @csrf
          <!-- フォロー解除-->
          <td> <div class="search-ff"><button type="submit" class="btn btn-danger">フォロー解除</button></div></td>
        </form>
        @else
        <form action="{{ route('Follow', ['user' => $user->id]) }}"  method="post">  <!-- フォローする-->
        @csrf
        <td> <div class="search-ff"><button type="submit" class="btn btn-primary">フォローする</button></div></td>
    </div>
        </div>
             </div>
        </form>

          @endif
        </tr>
        @endif
        @endforeach
    </table>
</div>

 @endsection
