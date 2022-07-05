@extends('layouts.manage-layout')

@section('content')
<div class="container-wrapper">
  <div class="subcontainer schedule">
    <div class="content-wrapper">
    <h4>スケジュール一覧</h4>

    <div class="grid-action-wrapper">
      <div class="grid-action">
        @include($viewPrefix.'._filter', ['obj' => $obj])
      </div>
      <div class="grid-action">
        <a href="{{route($routePrefix.'.create')}}">
          <button class="btn btn-outline-secondary">
            <i class="c_icon fas fa-plus menu-icon"></i> 作成
          </button>
        </a>
      </div>
    </div>
    <table class="grid-table table table-striped table-bordered table-responsive-sm">
    @include('components.table.header',[
      'headers' => [
        'action' => ['sortable' => false, 'title' => trans('common.action')],
        'category' => ['sortable' => true, 'title' => trans('common.category')],
        'name' => ['sortable' => true, 'title' => trans('common.name')],
        'navigator' => ['sortable' => true, 'title' => trans('common.navigator')],
        'start_at' => ['sortable' => true, 'title' => trans('common.start_at')],
        'location' => ['sortable' => true, 'title' => trans('common.location')],
        'is_active' => ['sortable' => true, 'title' => trans('common.is_active')],
        'created_at' => ['sortable' => true, 'title' => trans('common.created_at')],
      ]
    ])
      <tbody>
      @foreach($data as $row)
        <tr>
          <td>
            <div class="icon-wrapper">
              <a href="{{route($routePrefix.'.view', ['id' => $row->id])}}">
                <span class="action-icon">
                  <i class="c_icon icon fas fa-eye menu-icon" title="view"></i>
                </span>
              </a>
            </div>
            <div class="icon-wrapper">
              <a href="{{route($routePrefix.'.update', ['id' => $row->id])}}">
                <span class="action-icon">
                  <i class="c_icon icon fas fa-edit menu-icon" title="edit"></i>
                </span>
              </a>
            </div>
            <div class="icon-wrapper">
              <a href="{{route($routePrefix.'.clone', ['id' => $row->id])}}">
                <span class="action-icon">
                  <i class="c_icon icon fas fa-copy menu-icon" title="copy"></i>
                </span>
              </a>
            </div>
            <div class="icon-wrapper">
            <form class="form-grid-delete"
              id="form-grid-delete"
              action="{{ route('manage.schedule.delete', ['id' => $row->id]) }}"
              method="POST"
              style="display: none;">
            @csrf
            </form>
              <a href="#" class="grid-delete" onClick="document.getElementById('form-grid-delete').submit()">
                <span class="action-icon">
                  <i class="c_icon icon fas fa-trash menu-icon" title="delete"></i>
                </span>
              </a>
            </div>
          </td>
          <td>{{ \App\Helpers\ApplicationConstant::getLabel('SCHEDULE_CATEGORY', $row->category) }}</td>
          <td>{{$row->name}}</td>
          <td>{{ $row->seminarNavigator->name }}</td>
          <td>{{$row->start_at}}</td>
          <td>{!! nl2br($row->location) !!}</td>
          <td>
            <form action="{{route('helpers.activation')}}"
              id="grid-action-activation-{{$row->id}}"
              method="POST"
            >
              @csrf
              <input type="hidden" name="model" value="Schedule"/>
              <input type="hidden" name="id" value="{{$row->id}}"/>
            </form>
            @if($row->is_active == 0)
            <button class="btn btn-success"
              onClick="document.getElementById('grid-action-activation-{{$row->id}}').submit()">
              <i class="c_icon fas fa-check menu-icon"></i> 有効にする
            </button>
            @else
            <button class="btn btn-danger"
              onClick="document.getElementById('grid-action-activation-{{$row->id}}').submit()">
              <i class="c_icon fas fa-times menu-icon"></i> 無効にする
            </button>
            @endif
          </td>
          <td>{{$row->created_at}}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
    @include('components.table.pagination', ['data' => $data])
    </div>
  </div>
</div>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => 'スケジュール一覧'])
@endsection
