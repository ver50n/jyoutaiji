@extends('layouts.base-layout')

@section('content')
  <div class="container-wrapper schedule">
    <h4 class="subheader">@lang('common.schedule-subheader')</h4>
    <div class="subcontainer calendar-wrapper">
      
      <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css"></link>

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var calendarEl = document.getElementById('calendar');
          var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            dayMaxEvents: 3,
            locale: 'ja',
            contentHeight:"auto",
            eventClick: function (info) {
              window.location.href = "/schedule-detail/"+info.event.extendedProps.eventId
            },
            events: '{{ route('helpers.load-schedule', ['category' => Request::get('category')]) }}',
          });
          calendar.render();

          $('.change-view').click(function() {
            view = $(this).attr("data");
            calendar.changeView(view);
          });
        });
      </script>
      <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-secondary change-view" data="dayGridMonth"><i class="fas fa-calendar-alt"></i> カレンダー</button>
        <button type="button" class="btn btn-secondary change-view" data="listMonth"><i class="fas fa-list"></i> 表</button>
      </div>
      <div id='calendar'></div>
    </div>
  </div>
@endsection

@section('stylesheet')
  <link href="{{mix('css/pages/schedule.css')}}" rel="stylesheet">
@endsection

@section('meta')
@include('layouts.includes.meta', [
  'url' => route('pages.schedule'),
  'title' => trans('common.schedule')
])
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => trans('common.schedule')])
@endsection