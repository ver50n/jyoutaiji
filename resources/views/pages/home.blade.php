@extends('layouts.base-layout')

@section('content')

<div class="c_page-header-background">
</div>
<div class="container-wrapper home">
  <div class="subcontainer welcome">
    <h4 class="subheader">@lang('common.welcome-to-jyoutaiji')</h4>
    <div class="c_short-introduction">
      <span class="sub-brand">@lang('common.sub-brand')</span><br />
      <span class="brand">@lang('common.brand')</span>
    </div>
    <div class="e_btn-type3" style="margin-top: 30px;">
      @lang('common.about-jyoutaiji')
    </div>
  </div>
  <div class="subcontainer announcement">
    <h4 class="subheader">@lang('common.announcement')</h4>
    <ul>
      @foreach($announcements as $announcement)
      <li>{{ date('Y年m月d日', strtotime($announcement->created_at)) }}, {{ date('H時i分', strtotime($announcement->created_at)) }} (@lang('application-constant.DAY_OF_WEEK.'.date('N', strtotime($announcement->created_at)))) : {{ $announcement->content }}</li>
      
      @endforeach
    </ul>
    <a href="{{ route('pages.announcement') }}" class="button-link">
      <div class="e_btn-type3">@lang('common.see-more')</div>
    </a>
  </div>
  <div class="subcontainer schedule">
    <h4 class="subheader">@lang('common.schedule')</h4>
    <table class="table table-bordered table-striped table-hover table-condensed">
      <thead>
        <tr>
          <th><label>@lang('common.schedule')</label></th>
          <th><label>@lang('common.start_at')</label></th>
        </tr>
      </thead>
      <tbody>
        @foreach($schedules as $schedule)
        <tr>
          <td><label><a href="{{ route('pages.schedule-detail', ['id' => $schedule->id]) }}"> {{ $schedule->name }} </a></label></td>
          <td><label>{{ date('Y年m月d日', strtotime($schedule->start_at)) }}, {{ date('H時i分', strtotime($schedule->start_at)) }} (@lang('application-constant.DAY_OF_WEEK.'.date('N', strtotime($schedule->start_at))))</label></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <a href="{{ route('pages.schedule') }}" class="button-link">
      <div class="e_btn-type3">@lang('common.see-more')</div>
    </a>
  </div>
</div>
@endsection

@section('stylesheet')
  <link href="{{mix('css/pages/home.css')}}" rel="stylesheet">
@endsection

@section('meta')
  @include('layouts.includes.meta', [
    'url' => route('pages.root'),
    'title' => trans('common.home')
  ])
@endsection

@section('javascript')
@endsection

@section('title')
  @include('layouts.includes.title')
@endsection