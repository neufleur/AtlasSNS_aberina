@extends('layouts.login')

@section('content')


<div id="search">
    <form action='/search' method="post"> <!--actionを変える -->
        @csrf
        <input type="text" name="keyword" placeholder="ユーザー名" > <!--name="keyword"で入力されたものを入れる -->
        <button id="sbtn" type="submit"><img src="{{ asset('images/search.png') }}" >
        </button>
    </form>

</div>
<!-- 保存されているユーザー一覧 -->
<div class="container-list">

    <table class="table table-hover">
        @foreach ($users as $users)
        <!-- foreach 順番に取り出す($配列　as $値を入れる変数) -->
        <!-- 今自分がログインしているユーザー　==　他の人がログインしているユーザー 2つの値が異なるかどうかを確認　-->
        @if (!(Auth::user()->username == $users->username))
        <tr>
        <td><img src="{{ $users->images }}"></td>
            <td>{{ $users->username }}</td>
        </tr>
        @endif
        @endforeach
    </table>
</div>

 @endsection
