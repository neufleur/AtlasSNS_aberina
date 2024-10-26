@extends('layouts.login')

@section('content')
                <!-- 一覧表示 -->
                <form action='/follower-list' method="get">

                @csrf
                <div class="follower-images">
                        <!-- foreach 順番に取り出す($配列　as $値を入れる変数(単数)) -->
                <!-- フォローしてる画像のid(ユーザー)　==　ログインしているユーザーの画像　2つの値が異なるかどうかを確認　-->
                <h2>Follower list</h2>
                        @foreach ($images as $images)
                        @if($images->id !== Auth::user()->$images)
                        <a  href="{{ url('/profile-users')}}"> <img src="{{ asset('storage/images/' . $images->images) }}"></a>
                        @endif
                @endforeach
                        </div>
                        <div class="follower-post">
                        @foreach ($post as $post)
                        <a href="{{ url('/profile-users')}}"><img src="{{ asset('storage/images/' . $post->user->images) }}"></a>
                        <br>{{$post->user->username}}</br>
                        <br>{{$post->created_at}}</br>
                        <br>{{$post->post}}</br>
                        @endforeach
                </div>

                        </form>

@endsection