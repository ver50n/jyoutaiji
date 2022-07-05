@extends('layouts.manage-layout')

@section('content')
<div class="container-wrapper">
  <div class="subcontainer company-history">
    <div class="content-wrapper">
    <h4>履歴一覧</h4>

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
        'timeline_tag' => ['sortable' => true, 'title' => trans('common.timeline_tag')],
        'event_tag' => ['sortable' => true, 'title' => trans('common.event_tag')],
        'is_active' => ['sortable' => true, 'title' => trans('common.is_active')],
        'created_at' => ['sortable' => true, 'title' => trans('common.created_at')],
      ]
    ])
      <tbody>
      @foreach($data as $row)
        <tr>
          <td>
            <div class="icon-wrapper">
              <a href="{{route($routePrefix.'.update', ['id' => $row->id])}}">
                <span class="action-icon">
                  <i class="c_icon icon fas fa-edit menu-icon" title="edit"></i>
                </span>
              </a>
            </div>
            <div class="icon-wrapper">
            <form class="form-grid-delete"
              id="form-grid-delete"
              action="{{ route('manage.company-history.delete', ['id' => $row->id]) }}"
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
          <td>{{$row->timeline_tag}}</td>
          <td>{{$row->event_tag}}</td>
          <td>
            <form action="{{route('helpers.activation')}}"
              id="grid-action-activation-{{$row->id}}"
              method="POST"
            >
              @csrf
              <input type="hidden" name="model" value="CompanyHistory"/>
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
  @include('layouts.includes.title', ['title' => '履歴一覧'])
@endsection
