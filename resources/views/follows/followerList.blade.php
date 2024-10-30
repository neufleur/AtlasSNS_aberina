@extends('layouts.login')

@section('content')
                <!-- 一覧表示 -->
                <form action='/follower-list' method="get">
                @csrf
                <div class="ff-images">
                <h2>Follower list</h2>
                        <!-- foreach 順番に取り出す($配列　as $値を入れる変数(単数)) -->
                <!-- フォローしてる画像のid(ユーザー)　==　ログインしているユーザーの画像　2つの値が異なるかどうかを確認　-->
                <div class="f-img">
                        @foreach ($images as $images)
                        @if($images->id !== Auth::user()->$images)
                        <a  href="{{ url('/profile-users',$images->id)}}"> <img src="{{ asset('storage/images/' . $images->images) }}" width="90px" height="90px"></a>
                        @endif
                @endforeach
                    </div>
                        </div>

                        @foreach ($post as $post)
                        <div class="ff-post">
                        <a href="{{ url('/profile-users',$post->user->id)}}"><img class="ff-img" src="{{ asset('storage/images/' . $post->user->images) }}" width="90px" height="90px"></a>
                        <div class="f-post-name"><br>{{$post->user->username}}</br>
                        <br>{{$post->post}}</br></div>
                        <div class="f-at"><span>{{$post->created_at}}</span></div>
                        </div>
                        @endforeach
                        </form>

@endsection