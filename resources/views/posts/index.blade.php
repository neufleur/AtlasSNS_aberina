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
<label><textarea name="post.text" name="post" placeholder="投稿内容を入力してください" value="" cols="90" rows="6"></textarea></label>
<button id="sbtn" type="submit"><img src="{{ asset('images/post.png') }}" >
{{ Form::close() }}


<!-- 一覧表示 -->
@foreach($authors as $author)
                <option value="{{ $author->id }}">
                {{$author->username}}
                </option>
                <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->user_id }}</td>
                <td>{{ $post->post }}</td>
                <!-- authorがBook.php（モデル）に定義したメソッドで、nameがテーブルのカラム名を表しています。 -->
                <!-- <td>{{ $post->update }}</td> -->
                <!-- <td>{{ $post->created_at }}</td> -->
                <!-- <td><a class="btn btn-primary" href="/book/{{$book->id}}/update-form">更新</a></td> -->
           <!-- <td><a class="btn btn-danger" href="/book/{{$book->id}}/delete" onclick="return confirm('こちらの投稿を削除します。よろしいでしょうか？')">削除</a></td> -->
           <!-- 更新ボタンの作成 app.css」に用意されているボタンレイアウトを反映するために、クラス名「btn-primary」を追加 HTTPの通信方法をGETにして、URLにパラメータを一緒に送れるように-->
                <!-- ↓　ここを追加してください こちらもパラメータ付きのGET送信になるので、移動先のURL指定に各リストのID番号を設置しております。 -->
            </tr>
                @endforeach


</div>
@endsection