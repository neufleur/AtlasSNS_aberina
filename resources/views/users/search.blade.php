@extends('layouts.login')

@section('content')


<div id="/search">
    <form action='/search' method="post"> <!--actionを変える -->
        @csrf
        <input type="text" name="keyword" placeholder="ユーザー名" >
         @if(!empty($keyword))
        <div class="alert alert-primary">{{$keyword}}</div>
        <!--name="keyword"で入力されたものを入れる -->
        <button id="sbtn" type="submit"><img src="{{ asset('images/search.png') }}" ></button>
        @endif
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

         <!-- フォローするフォロー解除ボタン機能-->
        @if(auth()->user()->isFollowing($user->id))

        <!--ログインしているユーザー　フォローするデータ送る  -->
        <form action='/users/{{$user->id}}/nofollow' method="post">  <!-- フォロー解除-->
          <td><button type="submit" id="ff" class="btn btn-danger"><label class="ff-button" for="ff">フォロー解除</label></button></td>
        </form>
        @else
        <form action='/users/{{$user->id}}/follow' method="post"><!-- フォローする-->
        @csrf
        <td><button type="submit" id="ff" class="btn btn-primary"><label class="ff-button" for="ff">フォローする</label></button></td>
        </form>
        
          @endif
        </tr>
        @endif
        @endforeach
    </table>
</div>

 @endsection
