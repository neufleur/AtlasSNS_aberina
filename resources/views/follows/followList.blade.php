@extends('layouts.login')

@section('content')


                <!-- 一覧表示 -->
                <form action='/follow-list' method="get">
                @csrf
                <div class="follow-images">
                      <!-- foreach 順番に取り出す($配列　as $値を入れる変数(単数)) -->
        <!-- フォローしてる画像のid(ユーザー)　==　ログインしているユーザーの画像　2つの値が異なるかどうかを確認　-->
                @foreach ($images as $images)
                @if($images->id !== Auth::user()->$images)
                 <img src="{{ asset('storage/images/' . $images->images) }}">
                @endif
               @endforeach
                </div>

                <div class="follow-post">
                @foreach ($post as $post)
                </div class="follow-post">
                <img src="{{ asset('storage/images/' . $post->user->images) }}">
                <br>{{$post->user->username}}</br>
                <br>{{$post->user->created_at}}</br>
                <br>{{$post->$post}}</br>
                 @endforeach
               </div>


                </form>

@endsection