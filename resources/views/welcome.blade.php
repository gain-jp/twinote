@extends('layout.common')

@section('title', 'トップページ')
@section('description', 'Twinote　トップページ')
@section('keywords', 'Twinote,ツイノート,Twitter,ツイッター,memo,メモ')

@include('layout.header')

@section('content')
<h2>Twinote - ツイノート</h2>
<p>Twitter Web App 用 ブラウザ拡張機能</p>

<h2>機能</h2>
<ul>
    <li>特定のTwitterユーザーに対し、固定の名前を付けられる</li>
    <li>自分のプロフィールページに、メモを書き込める</li>
</ul>

@endsection

@include('layout.footer')