@extends('layout.common')

@section('title', '新規会員登録')
@section('description', 'Twinoteの新規会員登録ページです。')
@section('keywords', 'Twinote,ツイノート,Twitter,ツイッター,memo,メモ')

@include('layout.header')

@section('content')
<form action="register/send" method="post" class="mt-3 text-center">
    @csrf
    <div class="input-group mb-3">
        <span class="input-group-text">メールアドレス</span>
        <input type="email" class="form-control" name="email" placeholder="メールアドレス" required="">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text">パスワード</span>
        <input type="password" class="form-control" name="password" placeholder="パスワード" required="">
    </div>
    <button class="btn btn-primary">仮登録</button>
</form>
@endsection

@include('layout.footer')