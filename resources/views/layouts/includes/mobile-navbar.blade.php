<div class="mobile-navbar">
  <div class="mobile-nav">
    <a class="mobile-nav-link" href="{{ route('pages.schedule') }}">
      <i class="c_icon fas fa-calendar-alt mobile-nav-icon"></i>
      <span>@lang('common.schedule')</span>
    </a>
  </div>
  <div class="mobile-nav">
    <a class="mobile-nav-link" href="{{ route('pages.home') }}">
      <i class="c_icon fas fa-home mobile-nav-icon"></i>
      <span>@lang('common.home')</span>
    </a>
  </div>
  <div class="mobile-nav">
    <a class="mobile-nav-link" href="#"
      data-toggle="modal"
      data-target="#helper-modal">
      <i class="c_icon fas fa-info-circle mobile-nav-icon"></i>
      <span>@lang('common.help')</span>
    </a>
  </div>
</div>

@section('modal')
@parent
  @include('layouts.includes._helper-modal')
@endsection