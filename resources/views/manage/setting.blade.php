@extends('layouts.manage-layout')
@section('content')
<div class="container-wrapper">
  <section class="container">
    <div class="subcontainer setting">
      <h4>@lang('common.setting')</h4>
      <section class="card components__card-section-wrapper">
        <div class="card-header">
          <a data-toggle="collapse" href="#collapse-view__change-password"
          aria-expanded="true"
          aria-controls="collapse-view__change-password"
          id="view" class="d-block">
          <i class="c_icon fa fa-chevron-down pull-right"> @lang('common.change-password')</i>
          </a>
        </div>
        <div id="collapse-view__change-password" class="collapse show">
          <div class="card-body">
            @include('components.pages.change-password-form', ['postUrl' => route('manage.change-password-post')])
          </div>
        </div>
      </section>
    </div>
  </section>
</div>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => \Lang::get('common.setting')])
@endsection