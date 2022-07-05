@extends('layouts.manage-layout')
@section('content')
  <h4>履歴変更</h4>
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
			<form action="{{route('helpers.activation')}}"
				id="grid-action-activation"
				method="POST"
			>
				@csrf
        <input type="hidden" name="model" value="CompanyHistory"/>
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
        @include($viewPrefix.'._update-form')
      </div>
    </div>
  </section>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => '履歴変更'])
@endsection