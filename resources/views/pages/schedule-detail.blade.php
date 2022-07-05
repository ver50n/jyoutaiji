@extends('layouts.base-layout')

@section('content')
  <div class="c_page-header">
    <div class="placeholder-background" style="background: url('{{ mix('/images/bg-schedule.jpeg') }}');"></div>
    <div class="subcontainer page-header">
      <div class="info">
        <div class="text">
          <div class="title">
            @lang('common.schedule')
          </div><br />
        </div>
      </div>
    </div>
  </div>

  <div class="container-wrapper calendar-info">
    <h4 class="subheader">@lang('common.schedule')</h4>
    <div class="subcontainer calendar-info-wrapper">
      <div class="actions">
        <div class="action">
          <a href="{{ route('pages.schedule') }}">
            <div class="btn btn-small btn-outline-secondary">
                <i class="fas fa-caret-left c_icon"></i> @lang('common.schedule')
              </div>
            </div>
          </a>
        </div>
        @if($schedule->poster)
        <div class="action">
          <a href="{{ route('helpers.download-file', ['path_name' => 'schedule_poster','file_name' => $schedule->poster ]) }}">
            <div class="btn btn-small btn-outline-secondary">
              <i class="fas fa-cloud-download-alt c_icon"></i> @lang('common.download')
            </div>
          </a>
        </div>
        @endif

        @if($schedule->isAllowedToApply() === true)
        <div class="action">
          <a class="schedule-apply-nav-link" href="#"
            data-toggle="modal"
            data-target="#schedule-apply-modal">
            <div class="btn btn-small btn-outline-secondary">
              <i class="fas fa-person-booth c_icon"></i> @lang('common.apply')
            </div>
          </a>
        </div>
        @endif
      </div>

      <div class="table-responsive-sm">
        <table class="table table-bordered table-striped table-hover table-condensed">
          <tbody>
            <tr>
              <th class="schedule-label">@lang('common.schedule')</th>
              <td><div class="mobile-label">@lang('common.schedule')</div>{{$schedule->name}}</td>
            </tr>

            <tr>
              <th class="schedule-label">@lang('common.short_desc')</th>
              <td><div class="mobile-label">@lang('common.short_desc')</div>{!! nl2br($schedule->short_desc) !!}</td>
            </tr>
            
            <tr>
              <th class="schedule-label">@lang('common.desc')</th>
              <td><div class="mobile-label">@lang('common.desc')</div>{!! nl2br($schedule->desc) !!}</td>
            </tr>

            <tr>
              <th class="schedule-label">@lang('common.navigator')</th>
              <td>
                <div class="mobile-label">@lang('common.navigator')</div>
                <img src="{{ \App\Utils\FileUtil::getImageUrl('profile_image', $schedule->seminarNavigator->profile_image) }}" width="300" />
                <br />
                <h5>{{ $schedule->seminarNavigator->name }}</h5>
                <h6>{{ $schedule->seminarNavigator->occupation }}</h6>
                <br />
                {!! nl2br($schedule->seminarNavigator->short_desc) !!}
              </td>
            </tr>

            <tr>
              <th class="schedule-label">@lang('common.start_at')</th>
              <td><div class="mobile-label">@lang('common.start_at')</div>( @lang('application-constant.DAY_OF_WEEK.'.date('N', strtotime($schedule->start_at))) ) {{ date('Y-m-d H:i', strtotime($schedule->start_at)) }}</td>
            </tr>

            <tr>
              <th class="schedule-label">@lang('common.end_at')</th>
              <td><div class="mobile-label">@lang('common.end_at')</div>
                @if($schedule->end_at)
                ( @lang('application-constant.DAY_OF_WEEK.'.date('N', strtotime($schedule->end_at))) ) {{ date('Y-m-d H:i', strtotime($schedule->end_at)) }}
                @else
                  @lang('common.one-day')
                @endif
              </td>
            </tr>

            <tr>
              <th class="schedule-label">@lang('common.location')</th>
              <td><div class="mobile-label">@lang('common.location')</div>{!! nl2br($schedule->location) !!}</td>
            </tr>

            <tr>
              <th class="schedule-label">@lang('common.cost')</th>
              <td><div class="mobile-label">@lang('common.cost')</div>{{ number_format($schedule->cost) }} 円</td>
            </tr>

            @if($schedule->poster)
            <tr>
              <th class="schedule-label">@lang('common.poster')</th>
              <td><div class="mobile-label">@lang('common.poster')</div>
                <img src="{{ \App\Utils\FileUtil::getImageUrl('schedule_poster', $schedule->poster) }}" width="300"/> <br />
              </td>
            </tr>
            @endif

            <tr>
              <th class="schedule-label">@lang('common.participant_limit')</th>
              <td>
                <div class="mobile-label">@lang('common.participant_limit')</div>
                @lang('common.participant') : {{ number_format($schedule->participant->count()) }} / {{ number_format($schedule->participant_limit) }}<br />
                <div class="participant-list">
                @foreach($schedule->participant as $participant)
                  @include('components.schedule-participant', [
                    'participant' => $participant,
                    'size' => '50px'
                  ])
                @endforeach
                </div>
                @lang('common.applicant') : {{ number_format($schedule->applier->count()) }} / {{ number_format($schedule->participant_limit) }}<br />
                <div class="participant-list">
                @foreach($schedule->applier as $applier)
                  @include('components.schedule-participant', [
                    'participant' => $applier,
                    'size' => '50px'
                  ])
                @endforeach
                </div>
              </td>
            </tr>
            
            @if($schedule->enquete_url)
            <tr>
              <th class="schedule-label">@lang('common.enquete_url')</th>
              <td>
                <div id="enquete_url_qr"></div>
                <br />
                <a href="{{$schedule->enquete_url}}" target="_blank">{{$schedule->enquete_url}}</a></label>
              </td>
            </tr>
            @endif
          <tbody>
        </table>
      </div>
      @if(count($scheduleDetails) > 0)
      <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css"></link>

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var calendarEl = document.getElementById('calendar');
          var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
              left: '', 
              center: 'title',
              right: '',
            },
            initialView: 'timeGrid',
            locale: 'ja',
            slotLabelInterval: '00:30',
            contentHeight:"auto",
            visibleRange: {
              start: '{{ date('Y-m-d H:i', strtotime($schedule['start_at'])) }}',
              end: '{{ date('Y-m-d H:i', strtotime($schedule['end_at'])) }}',
            },
            eventTimeFormat: {
              hour: '2-digit',
              minute: '2-digit',
              meridiem: false
            },
            events: {!! json_encode($scheduleDetails) !!},
          });
          calendar.render();
        });
      </script>
      <div id='calendar'></div>
      @endif
    </div>
  </div>
@endsection

@section('modal')
  <!-- Modal -->
  <div class="modal fade"
    id="schedule-apply-modal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="schedule-apply-modal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">@lang('common.schedule') @lang('common.apply')</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body ">
          <div class="schedule-apply">
            <form action="{{ route('pages.schedule-detail.apply', ['id' => $schedule->id]) }}" method="POST">
              @csrf
              <div class="form-group">
                <label>@lang('common.name')</label> <span class="e_required">*</span>
                <input class="form-control input-sm"
                  name="name"
                  required
                  @if(Auth::check())
                    value="{{ Auth::user()->name }}"
                    readOnly="readOnly"
                  @endif

                  placeholder="@lang('common.name')" />
                <span class="c_form__error-block">{{$errors->first('name')}}</span>
              </div>

              <div class="form-group">
                <label>@lang('common.note')</label>
                <textarea class="form-control input-sm"
                  name="note"
                  placeholder="@lang('common.note')">{{ old('note') }}</textarea>
                <span class="c_form__error-block">{{$errors->first('note')}}</span>
              </div>

              <div>
                <button type="submit" class="btn btn-primary">
                  <span class="action-icon">
                    <i class="fas fa-person-booth c_icon"></i> @lang('common.apply')
                  </span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
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

@section('javascript')
  <script type="text/javascript" src="/vendor/qr-code/jquery.qrcode.min.js"></script>
  <script type="text/javascript" src="/vendor/qr-code/qrcode.js"></script>
  <script>
    $(document).ready(function() {
      $('#enquete_url_qr').qrcode("{{ $schedule->enquete_url }}");
    })
  </script>
@endsection