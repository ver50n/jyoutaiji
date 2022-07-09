@extends('layouts.manage-layout')
@section('content')

<div class="container-wrapper">
  <div class="subcontainer schedule">
    <div class="content-wrapper">
      <h4>スケジュール観覧</h4>
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
                  <th><label>@lang('common.type')</label></th>
                  <td><label>{{ \App\Helpers\ApplicationConstant::getLabel('SCHEDULE_TYPE', $obj->type) }}</label></td>
                </tr>
                <tr>
                  <th><label>@lang('common.navigator')</label></th>
                  <td><label>{{ $obj->seminarNavigator->name }}</label></td>
                </tr>
                <tr>
                  <th><label>@lang('common.category')</label></th>
                  <td><label>{{ \App\Helpers\ApplicationConstant::getLabel('SCHEDULE_CATEGORY', $obj->category) }}</label></td>
                </tr>
                <tr>
                  <th><label>@lang('common.name')</label></th>
                  <td><label>{{$obj->name}}</label></td>
                </tr>
                <tr>
                  <th><label>@lang('common.short_desc')</label></th>
                  <td><label>{{$obj->short_desc}}</label></td>
                </tr>
                <tr>
                  <th><label>@lang('common.desc')</label></th>
                  <td><label>{{$obj->desc}}</label></td>
                </tr>
                <tr>
                  <th><label>@lang('common.location')</label></th>
                  <td><label>{!! $obj->location !!}</label></td>
                </tr>
                <tr>
                  <th><label>@lang('common.cost')</label></th>
                  <td><label>{{$obj->cost}}</label></td>
                </tr>
                <tr>
                  <th><label>@lang('common.participant_limit')</label></th>
                  <td><label>{{$obj->participant_limit}}</label></td>
                </tr>
                <tr>
                  <th><label>@lang('common.start_at')</label></th>
                  <td><label>{{$obj->start_at}}</label></td>
                </tr>
                <tr>
                  <th><label>@lang('common.end_at')</label></th>
                  <td><label>{{$obj->end_at}}</label></td>
                </tr>
                <tr>
                  <th><label>@lang('common.applicant')</label></th>
                  <td>
                    @foreach($obj->applier as $applicant)
                      {{ $applicant->name }} :
                      <a href="{{ route($routePrefix.'.approve-applicant', ['id' => $obj->id, 'applicationId'=>$applicant->id]) }}"><i class="fas fa-user-check"></i></a> | 
                      <a href="{{ route($routePrefix.'.reject-applicant', ['id' => $obj->id, 'applicationId'=>$applicant->id]) }}"><i class="fas fa-user-times"></i></a>
                      <br />
                      {{ $applicant->note }}
                    @endforeach
                  </td>
                </tr>
                <tr>
                  <th><label>@lang('common.participant')</label></th>
                  <td>
                    @foreach($obj->participant as $participant)
                      {{ $participant->name }} : <a href="{{ route($routePrefix.'.reject-applicant', ['id' => $obj->id, 'applicationId'=>$participant->id]) }}"><i class="fas fa-user-times"></i></a><br />
                      {{ $participant->note }}
                    @endforeach
                  </td>
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
</div>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => 'スケジュール観覧'])
@endsection

@section('javascript')
  <script type="text/javascript" src="/vendor/qr-code/jquery.qrcode.min.js"></script>
  <script type="text/javascript" src="/vendor/qr-code/qrcode.js"></script>
  <script>
    $(document).ready(function() {
      $('#enquete_url_qr').qrcode("{{ $obj->enquete_url }}");
    })
  </script>
@endsection