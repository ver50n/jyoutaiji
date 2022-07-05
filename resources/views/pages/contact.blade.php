@extends('layouts.base-layout')

@section('content')
  <div class="container-wrapper contact">
    <div class="subcontainer contact-info-wrapper">
      <h4 class="subheader">@lang('common.contact-info')</h4>
      <div class="contact-info">
        <div class="information">
          <h5>@lang('common.information')</h5>
          <div class="each-info-wrapper">
            <div class="icon">
              <i class="c_icon fas fa-building"></i>
            </div>
            <div class="info">
              <div class="label">@lang('common.address')</div>
                @lang('common.address-value')
                <i class="c_icon fas fa-map-marker-alt"></i> <a href="https://goo.gl/maps/LBo66YStkbaHgBwh7" target="_blank">Map Guide</a>
              <br />
            </div>
          </div>
          <div class="each-info-wrapper">
            <div class="icon"><i class="c_icon fas fa-clock"></i></div>
            <div class="info">
              <div class="label">@lang('common.business-hour')</div>
              <table>
                <tr>
                  <td>@lang('common.business-time')</td>
                  <td> : </td>
                  <td>10:00 - 12:00</td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td>
                    13:00 - 17:00<br />
                  </td>
                </tr>
                <tr>
                  <td>@lang('common.business-day-off')</td>
                  <td> : </td>
                  <td>@lang('common.business-day-off-value')</td>
                </tr>
              </table>
              <small class="text-muted">
                @lang('common.business-day-note')
              </small>
            </div>
          </div>
          <div class="each-info-wrapper">
            <div class="icon"><i class="c_icon fas fa-phone-alt"></i></div>
            <div class="info">
              <div class="label">@lang('common.phone')</div>
              <a href="tel: 08095871272">080 - 9587 - 1272</a>
              <br />
              <small class="text-muted">@lang('common.phone-response-note')</small>
              <br />
              <small class="text-muted">@lang('common.phone-response-day')</small>
            </div>
          </div>
          <div class="each-info-wrapper">
            <div class="icon">
              <i class="c_icon fas fa-envelope"></i>
            </div>
            <div class="info">
              <div class="label">@lang('common.email')</div>
              <a href = "mailto: office.jyoutaiji@gmail.com">office.jyoutaiji@gmail.com</a>
              <br />
              <small class="text-muted">@lang('common.email-response-note')</small>
            </div>
          </div>
          <div class="each-info-wrapper">
            <div class="icon">
              <i class="c_icon fas fa-share-alt-square"></i>
            </div>
            <div class="info">
              <div class="label">@lang('common.sns')</div>
              <div class="sns-wrapper">
                @include('components.sns-share-buttons',[
                  'twitterUrl' => 'https://twitter.com/joutaiji_shibu',
                  'fbUrl' => 'https://www.facebook.com/profile.php?id=100022037523880',
                  'instagramUrl' => 'https://www.instagram.com/joutaiji_shibu/',
                  'lineUrl' => 'http://line.me/ti/p/exaZu-yw23',
                  'webUrl' => config('app.url')
                ])
              </div>
            </div>
          </div>
          <!-- <div class="each-info-wrapper">
            <div class="icon">
              <i class="c_icon fab fa-line"></i>
            </div>
            <div class="info">
              <img src="https://qr-official.line.me/sid/M/081qldqj.png" />
            </div>
          </div> -->
        </div>
        <div class="contact-form">
          <h5>@lang('common.contact')</h5>
          <form action="{{ route('pages.contactPost') }}" method="POST" >
            @csrf
            <div class="form-row">
              <div class="col-md-12 mb-3">
                <label><span class="e_required">*</span> @lang('common.name')</label>
                <input class="form-control input-sm"
                  type="text"
                  name="name"
                  value="{{old('name')}}"
                  placeholder="@lang('common.input-name')"
                  autocomplete="off" required/>
                <small class="form-text text-error">{{$errors->first('name')}}</small>
              </div>
              <div class="col-md-12 mb-3">
                <label><span class="e_required">*</span> @lang('common.email')</label>
                <input class="form-control input-sm"
                  type="text"
                  name="email"
                  value="{{old('email')}}"
                  placeholder="@lang('common.input-email')"
                  autocomplete="off" required/>
                <small class="form-text text-error">{{$errors->first('email')}}</small>
              </div>
              <div class="col-md-12 mb-3">
                <label>@lang('common.phone')</label>
                <input class="form-control input-sm"
                  type="text"
                  name="phone"
                  value="{{old('phone')}}"
                  placeholder="@lang('common.input-phone')"
                  autocomplete="off"/>
                <small class="form-text text-error">{{$errors->first('phone')}}</small>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 mb-3">
                <label><span class="e_required">*</span> @lang('common.content')</label>
                <div class="input-group">
                  <textarea class="form-control input-sm"
                    rows="10"
                    type="text"
                    name="content" required>{{old('content')}}</textarea>
                  <small class="form-text text-error">{{$errors->first('content')}}</small>
                </div>
              </div>

              <div style="width: 100%; text-align:center;">
                <button class="e_btn">@lang('common.send')</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('stylesheet')
  <link href="{{mix('css/pages/contact.css')}}" rel="stylesheet">
@endsection

@section('meta')
@include('layouts.includes.meta', [
  'url' => route('pages.contact'),
  'title' => trans('common.contact')
])
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => trans('common.contact')])
@endsection