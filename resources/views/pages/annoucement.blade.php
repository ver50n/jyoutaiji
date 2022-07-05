@extends('layouts.base-layout')

@section('content')
  <div class="container-wrapper announcement">
    <div class="subcontainer news">
      <h4 class="announcement-subheader">@lang('common.announcement')</h4>
      
      <table class="grid-table table table-striped table-bordered table-responsive-sm">
      @include('components.table.header',[
        'headers' => [
          'created_at' => ['sortable' => true, 'title' => trans('common.created_at')],
          'content' => ['sortable' => true, 'title' => trans('common.content')],
        ]
      ])
        <tbody>
        @foreach($announcements as $announcement)
          <tr>
            <td>{{ date('Y年m月d日', strtotime($announcement->created_at)) }}, {{ date('H時i分', strtotime($announcement->created_at)) }} (@lang('application-constant.DAY_OF_WEEK.'.date('N', strtotime($announcement->created_at))))</td>
            <td>{{$announcement->content}}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
      @include('components.table.pagination', ['data' => $announcements])
    </div>
  </div>
@endsection

@section('meta')
@include('layouts.includes.meta', [
  'url' => route('pages.announcement'),
  'title' => trans('common.announcement')
])
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => trans('common.announcement')])
@endsection