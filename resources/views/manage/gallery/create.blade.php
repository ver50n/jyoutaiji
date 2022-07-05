@extends('layouts.manage-layout')
@section('content')

<div class="container-wrapper">
  <div class="subcontainer gallery">
    <h4>ギャラリー作成</h4>
    <div class="grid-action-wrapper">
      <div class="grid-action">
        <a href="{{route($routePrefix.'.list')}}">
          <button class="btn btn-outline-secondary">
            <i class="c_icon fas fa-receipt menu-icon"></i> 一覧
          </button>
        </a>
      </div>
    </div>
    <section class="card components__card-section-wrapper">
      <div class="card-header">
        <a data-toggle="collapse" href="#collapse-view__base-info"
          aria-expanded="true"
          aria-controls="collapse-view__base-info"
          id="view" class="d-block">
          <i class="c_icon fa fa-chevron-down pull-right"> 基本情報</i>
        </a>
      </div>
      <div id="collapse-view__base-info" class="collapse show">
        <div class="card-body">
          @include($viewPrefix.'._create-form')
        </div>
      </div>
    </section>
  </div>
</div>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => 'ギャラリー作成'])
@endsection