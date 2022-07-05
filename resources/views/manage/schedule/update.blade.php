@extends('layouts.manage-layout')
@section('content')
<div class="container-wrapper">
  <div class="subcontainer schedule">
    <div class="content-wrapper">
	    <h4>スケジュール変更</h4>
      <div class="grid-action-wrapper">
        <div class="grid-action">
          <a href="{{route($routePrefix.'.list')}}">
            <button class="btn btn-outline-secondary">
            <i class="c_icon fas fa-receipt menu-icon"></i> 一覧
            </button>
          </a>
        </div>
        <div class="grid-action">
          <a href="{{route($routePrefix.'.create')}}">
            <button class="btn btn-outline-secondary">
            <i class="c_icon fas fa-plus menu-icon"></i> 作成
            </button>
          </a>
        </div>
        <div class="grid-action">
          <a href="{{route($routePrefix.'.update', ['id' => $obj->id])}}">
            <button class="btn btn-outline-secondary">
            <i class="c_icon fas fa-edit menu-icon"></i> 変更
            </button>
          </a>
        </div>
        <div class="grid-action">
          <a href="{{route($routePrefix.'.view', ['id' => $obj->id])}}">
            <button class="btn btn-outline-secondary">
              <i class="c_icon fas fa-eye menu-icon"></i> 観覧
            </button>
          </a>
        </div>
        <div class="grid-action">
          <a href="{{route($routePrefix.'.clone', ['id' => $obj->id])}}">
            <button class="btn btn-outline-secondary">
              <i class="c_icon fas fa-copy menu-icon"></i> Clone
            </button>
          </a>
        </div>
        <div class="grid-action">
          <form action="{{route('helpers.activation')}}"
            id="grid-action-activation"
            method="POST">
            @csrf
        <input type="hidden" name="model" value="Schedule"/>
        <input type="hidden" name="id" value="{{$obj->id}}"/>
          </form>
        @if($obj->is_active == 0)
        <button class="btn btn-success"
        onClick="document.getElementById('grid-action-activation').submit()">
        <i class="c_icon fas fa-check menu-icon"></i> 有効にする
        </button>
        @else
        <button class="btn btn-danger"
        onClick="document.getElementById('grid-action-activation').submit()">
        <i class="c_icon fas fa-times menu-icon"></i> 無効にする
        </button>
        @endif
        </div>
        <div class="grid-action">
          <a href="{{route($routePrefix.'.render-export-file', ['id' => $obj->id])}}" target="_blank">
            <button class="btn btn-outline-secondary">
            <i class="c_icon fas fa-scroll menu-icon"></i> チラシ生成
            </button>
          </a>
        </div>
      </div>
    	@include($viewPrefix.'._update-form')
    </div>
  </div>
</div>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => 'スケジュール変更'])
@endsection