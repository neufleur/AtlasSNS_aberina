@extends('layouts.login')

@section('content')
@csrf
{{ Form::open(['url' => '/posts']) }}

 <!--新規投稿 <form action='/posts' method="post">  @csrfはフォームの外側に入力-->
<div id="post">
@if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
@endif
  <!-- バリデーションチェックに引っかかった場合、ビューファイルにエラーメッセージを表示させる必要がある 
具体的には、エラーメッセージが1つ以上存在するかどうかを確認し、エラーメッセージが存在する場合は、全てのエラーメッセージをforeachを使って表示させています。-->

<p class="icon"><img src="{{ asset('storage/images/' . Auth::user()->images) }}"></p>
<label><textarea name="post" placeholder="投稿内容を入力してください" value="" cols="20" rows="6"></textarea><button id="sbtn" type="submit"><img class="post-png" src="{{ asset('images/post.png') }}" ></button></label>


{{ Form::close() }}

<table class="table table-hover">
<!-- 一覧表示 -->
                @foreach($post as $post)
                <tr>
                <td>{{ asset('storage/images/' . Auth::user()->images ) }}</td>
                <!-- <td>{{ $post->id }}</td> -->
                <!-- <td>{{ $post->user_id }}</td> -->
                <td>{{ $post->post}}</td>
                <td>{{ $post->created_at->format('Y.m.d.G:i')}}</td>
                <!-- authorがBook.php（モデル）に定義したメソッドで、nameがテーブルのカラム名を表しています。 -->
                <td>{{ $post->update }}</td>
                <td>{{ $post->delete }}</td>
                <td><a class="btn btn-primary" href="/post/{{$post->id}}/update-form"><img class="edit-png" src="{{ asset('images/edit.png') }}" ></a></td>
                <td><a class="btn btn-danger" href="/post/{{$post->id}}/delete" onclick="return confirm('こちらの投稿を削除します。よろしいでしょうか？')"><img class="trash-h" src="{{ asset('images/trash-h.png') }}" ></a></td>
           <!-- 更新ボタンの作成 クラス名「btn-primary」を追加 HTTPの通信方法をGETにして、URLにパラメータを一緒に送れるように -->
                <!-- ↓　ここを追加してください こちらもパラメータ付きのGET送信になるので、移動先のURL指定に各リストのID番号を設置しております。 -->
            </tr>
                @endforeach



</table>
</div>
@endsection