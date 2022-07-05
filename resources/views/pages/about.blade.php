@extends('layouts.base-layout')
@section('content')
  <div class="container-wrapper about">
    <div class="subcontainer about-jyoutaiji">
      <div class="jumbotron">
        <span class="description">日蓮正宗 佛説山</span><br />
        <span class="english-title">Nichiren-Shoushu Bussetsuzan Joutaiji</span><br />
        <span class="title">誠諦寺</span>
      </div>
    </div>
  </div>
@endsection

@section('stylesheet')
  <link href="{{mix('css/pages/about.css')}}" rel="stylesheet">
  <link href="{{mix('css/components/scroll-history.css')}}" rel="stylesheet">
  <style>
    .about-jyoutaiji {
      text-align: center;
    }
    .description {
      font-size: 4rem;
    }
    .title {
      font-size: 12rem;
    }
  </style>
@endsection

@section('meta')
@include('layouts.includes.meta', [
  'url' => route('pages.about'),
  'title' => trans('common.about-jyoutaiji')
])
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => trans('common.about-jyoutaiji')])
@endsection