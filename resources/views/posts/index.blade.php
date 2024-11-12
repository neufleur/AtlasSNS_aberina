@extends('layouts.login')

@section('content')
@csrf
{{ Form::open(['url' => '/posts']) }}
 <!--新規投稿 <form action='/posts' method="post">  @csrfはフォームの外側に入力-->
<div id="post-all">
  <div class="post">
@if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
@endif
  <!-- バリデーションチェックに引っかかった場合、ビューファイルにエラーメッセージを表示させる必要がある @if($errors->any())から@endifまで
具体的には、エラーメッセージが1つ以上存在するかどうかを確認し、エラーメッセージが存在する場合は、全てのエラーメッセージをforeachを使って表示させています。-->
<div >
<p class="icon"><img class="post-images" src="{{ asset('storage/images/' . Auth::user()->images) }}" width="70px" height="70px">
<textarea name="post" placeholder="投稿内容を入力してください。" value="" cols="10" rows="3"></textarea>

<button class="post-png"><img class="post-png" src="{{ asset('images/post.png') }}" ></button></p>
</div>
</div>
{{ Form::close() }}

<table class="post-table table-hover">
                <!-- 一覧表示 -->
                <form action=/post/update method="get">
                @foreach($post as $post)
                <tr>
                <td class="p-img"><img src="{{ asset('storage/images/' . $post->user->images) }}" width="70px" height="70px"></td>
                <td>{{ $post->post}}</td>
                <td><div class="p-at">{{ $post->created_at->format('Y.m.d.G:i')}}</div></td>
                <!-- authorがBook.php（モデル）に定義したメソッドで、nameがテーブルのカラム名を表しています。 -->
                @if(Auth::user()->id ==$post->user_id)
                <!-- モーダルの中身 open -->
                <td><a class="js-modal-open" href="" post="{{ $post->post }}" post_id="{{ $post->id }}" href="/post/{{$post->id}}/update-Form"><img class="edit-png" src="{{ asset('images/edit.png') }}" ></a></td>
                <td><a class="trash-h" href="/post/{{$post->id}}/delete" onclick="return confirm('こちらの投稿を削除します。よろしいでしょうか？')"><img class="trash-h" src="{{ asset('images/trash-h.png') }}" ></a></td>
                @endif
           <!-- 更新ボタンの作成 クラス名「btn-primary」を追加 HTTPの通信方法をGETにして、URLにパラメータを一緒に送れるように -->
                <!-- ↓　ここを追加してください こちらもパラメータ付きのGET送信になるので、移動先のURL指定に各リストのID番号を設置しております。 -->
            </tr>
                @endforeach
                </form>
            <!-- モーダルの中身 close aタグはリンクに飛ぶタグを指定　-->
    <div class="modal js-modal">
        <div class="modal__bg js-modal-close"></div>
        <div class="modal__content">
        @csrf
           <form action=/post/update method="get">
            @if($errors->any())
         <div class="alert alert-danger">
           <ul>
               @foreach($errors->all() as $error)
             <li>{{ $error }}</li>
               @endforeach
            </ul>
        </div>
              @endif
                <textarea name="post" class="modal_post" cols="50" rows="8"></textarea>
                <input type="hidden" name="id" class="modal_id" value="">
                <button class=""><img class="edit-png" src="{{ asset('images/edit.png') }}" ></button>
                 <!--編集したものを送信されて保存するため使う　formタグの中に入れて反映させる　-->
                {{ csrf_field() }}
           </form>
        </div>
    </div>



</table>
</div>
@endsection
