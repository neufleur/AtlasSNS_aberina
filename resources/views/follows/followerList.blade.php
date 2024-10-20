@extends('layouts.login')

@section('content')
               <!-- 一覧表示 -->
               <form action='/follower-list' method="get">

               @csrf
               <div class="follower-images">
                      <!-- foreach 順番に取り出す($配列　as $値を入れる変数(単数)) -->
        <!-- フォローしてる画像のid(ユーザー)　==　ログインしているユーザーの画像　2つの値が異なるかどうかを確認　-->
                @foreach ($images as $images)
                @if($images->id !== Auth::user()->$images)
                 <img src="{{ asset('storage/images/' . $images->images) }}">
                @endif
               @endforeach
                </div>

                </form>

@endsection