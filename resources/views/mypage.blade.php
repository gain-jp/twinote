@extends('layout.common')

@section('title', 'マイページ')
@section('description', 'Twinoteのマイページです。')
@section('keywords', 'Twinote,ツイノート,Twitter,ツイッター,memo,メモ')

@include('layout.header')

@section('content')
拡張機能を<a href="{{config('app.url')}}/">こちら</a>からダウンロードして、tokenを設定してください。
token:{{$token}}
@endsection

@include('layout.footer')