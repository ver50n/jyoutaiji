@extends('layouts.base-layout')

@section('content')
<div class="container-wrapper">
  <section class="container">
    <div class="subcontainer login-form">
    @include('components.register-form')
    </div>
  </section>
</div>
@endsection

@section('stylesheet')
  <link href="{{ mix('css/pages/login.css') }}" rel="stylesheet">
@endsection

@section('meta')
@include('layouts.includes.meta', [
  'url' => route('register'),
  'title' => trans('common.register')
])
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => trans('common.register')])
@endsection