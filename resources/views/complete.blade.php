@extends('layout.common')

@section('title', '本登録完了')
@section('description', 'Twinoteの本登録完了ページです。')
@section('keywords', 'Twinote,ツイノート,Twitter,ツイッター,memo,メモ')

@include('layout.header')

@section('content')
本登録が完了しました。
<a href="{{Config::get('app.url')}}/twinote_user/login">こちら</a>からログインして、拡張機能をダウンロードしてください。
@endsection

@include('layout.footer')