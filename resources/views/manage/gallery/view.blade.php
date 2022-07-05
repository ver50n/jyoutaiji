@extends('layouts.manage-layout')
@section('content')
<div class="container-wrapper">
  <div class="subcontainer gallery">
    <h4>ギャラリー観覧</h4>
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
          <input type="hidden" name="model" value="Gallery"/>
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
          <i class="c_icon fa fa-chevron-down pull-right menu-icon"> 基本情報</i>
        </a>
      </div>
      <div id="collapse-view__base-info" class="collapse show">
        <div class="card-body">
          <table class="table table-bordered table-striped table-hover table-condensed">
            <tbody>
              <tr>
                <th><label>@lang('common.id')</label></th>
                <td><label>{{$obj->id}}</label></td>
              </tr>
              <tr>
                <th><label>@lang('common.title')</label></th>
                <td><label>{{$obj->title}}</label></td>
              </tr>
              <tr>
                <th><label>@lang('common.thumbnail')</label></th>
                <td><label><img width="200"src="{{ \App\Utils\FileUtil::getImageUrl('gallery_thumbnail', $obj->thumbnail) }}" /></label></td>
              </tr>
              <tr>
                <th><label>@lang('common.is_slider')</label></th>
                <td><label>{{App\Helpers\ApplicationConstant::YES_NO[$obj->is_slider]}}</label></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <section class="card components__card-section-wrapper">
      <div class="card-header">
        <a data-toggle="collapse" href="#collapse-view__status-info"
          aria-expanded="true"
          aria-controls="collapse-view__status-info"
          id="view" class="d-block">
          <i class="c_icon fa fa-chevron-down pull-right menu-icon"> ステータス情報</label></i>
        </a>
      </div>
      <div id="collapse-view__status-info" class="collapse show">
        <div class="card-body">
          <table class="table table-bordered table-striped table-hover table-condensed">
            <tbody>
              <tr>
                <th><label>@lang('common.is_active')</label></th>
                <td><label>{{App\Helpers\ApplicationConstant::YES_NO[$obj->is_active]}}</label></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <section class="card components__card-section-wrapper">
      <div class="card-header">
        <a data-toggle="collapse" href="#collapse-view__log-info"
          aria-expanded="true"
          aria-controls="collapse-view__log-info"
          id="view" class="d-block">
          <i class="c_icon fa fa-chevron-down pull-right menu-icon"> ログ情報</i>
        </a>
      </div>
      <div id="collapse-view__log-info" class="collapse show">
        <div class="card-body">
          <table class="table table-bordered table-striped table-hover table-condensed">
            <tbody>
              <tr>
                <th><label>@lang('common.created_at')</label></th>
                <td><label>{{$obj->created_at}}</label></td>
              </tr>
              <tr>
                <th><label>@lang('common.updated_at')</label></th>
                <td><label>{{$obj->updated_at}}</label></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </div>
</div>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => 'ギャラリー観覧'])
@endsection