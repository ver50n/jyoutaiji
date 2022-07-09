@extends('layouts.manage-layout')
@section('content')

<div class="container-wrapper">
  <div class="subcontainer contact">
    <h4>問い合せ観覧</h4>
    <div class="grid-action-wrapper">
      <div class="grid-action">
        <a href="{{route($routePrefix.'.list')}}">
          <button class="btn btn-outline-secondary">
            <i class="c_icon fas fa-receipt menu-icon"></i> 一覧
          </button>
        </a>
      </div>
      <div class="grid-action">
        <form action="{{route('helpers.activation')}}"
          id="grid-action-activation"
          method="POST"
        >
          @csrf
          <input type="hidden" name="model" value="Contact"/>
          <input type="hidden" name="id" value="{{$obj->id}}"/>
        </form>
        @if($obj->is_active == 0)
        <button class="btn btn-success"
          onClick="document.getElementById('grid-action-activation').submit()">
          <i class="c_icon fas fa-check menu-icon"></i> 対応済
        </button>
        @else
        <button class="btn btn-danger"
          onClick="document.getElementById('grid-action-activation').submit()">
          <i class="c_icon fas fa-times menu-icon"></i> 未対応
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
                <th><label>@lang('common.name')</label></th>
                <td><label>{{$obj->name}}</label></td>
              </tr>
              <tr>
                <th><label>@lang('common.email')</label></th>
                <td><label>{{$obj->email}}</label></td>
              </tr>
              <tr>
                <th><label>@lang('common.phone')</label></th>
                <td><label>{{$obj->phone}}</label></td>
              </tr>
              <tr>
                <th><label>@lang('common.content')</label></th>
                <td><label>{!! nl2br($obj->content) !!}</label></td>
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
                <th><label>@lang('common.is_responded')</label></th>
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
  @include('layouts.includes.title', ['title' => '問い合せ観覧'])
@endsection