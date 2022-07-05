<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.includes.asset')
    @yield('meta')
    @yield('title')
  </head>

  <body>
    <div id="app" class="global-wrapper">
      <div class="overlay"></div>
      @include('layouts.includes.navbar')
      <div class="container-fluid">
        <div class="body-container">
          @if (session('success'))
            <div class="alert alert-success">
              <strong>@lang('common.success') : </strong>@lang('common.notify.'.session('success'))
              <button type="button" class="close" onclick="$('.alert').hide()">&times;</button>
            </div>
            @endif
            
            @if (session('error'))
            <div class="alert alert-danger">
              <strong>@lang('common.error') : </strong>@lang('common.notify.'.session('error'))
              <button type="button" class="close" onclick="$('.alert').hide()">&times;</button>
            </div>
          @endif
          @yield('content')
        </div>
        @include('layouts.includes.footer')
        @include('layouts.includes.mobile-navbar')
      </div>
    </div>

    <div class="elevator">
      <div class="elevator-button go-top"><i class="fas fa-caret-up"></i></div>
      <div class="elevator-button go-bottom"><i class="fas fa-caret-down"></i></div>
    </div>
    <a class="sitemap-btn" href="#"
      data-toggle="modal"
      data-target="#sitemap-modal">
      <div class="sitemap-button"><i class="fas fa-sitemap"></i></div>
    </a>
  </body>
  @yield('modal')
  @include('layouts.includes._sitemap-modal')
  @include('layouts.includes._language-selection-modal')

  @include('layouts.includes.header')
</html>
