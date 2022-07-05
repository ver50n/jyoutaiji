@extends('layouts.base-layout')

@section('content')
  <div class="container-wrapper login-form">
    <div class="subcontainer login-form-wrapper">
      @include('components.login-form', [
        'loginUrl' => route('login-post')
      ])
    </div>
  </section>
@endsection

@section('stylesheet')
  <link href="{{ mix('css/pages/login.css') }}" rel="stylesheet">
@endsection

@section('meta')
@include('layouts.includes.meta', [
  'url' => route('login'),
  'title' => trans('common.login')
])
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => 'login'])
@endsection