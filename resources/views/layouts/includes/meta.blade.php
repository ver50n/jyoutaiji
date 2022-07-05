@if(isset($metas))
@foreach($metas as $meta)
  <meta property="{{ $meta['property'] }}"
    content="{{ $meta['content'] }}" />
@endforeach
@else
@php
  $type = isset($type) ? $type : 'website';
  $default = trans('common.brand-tagline');
  $title = isset($title) ? $title : $default;
  $title .= ' - '.trans('common.brand');
  $url = isset($url) ? $url : config('app.url')
@endphp
<meta property="og:url"
  content="{{ $url }}" />
<meta property="og:type"
  content="{{ $type }}" />
<meta property="og:title"
  content="{{ $title }}" />
<meta property="og:description"
  content="{{ trans('common.brand-short-description') }}" />
<meta property="og:image"
  content="{{ asset('images/logo.png') }}" />
@endif
<meta property="fb:app_id" content="{{ config('sns_account.fb.app_id') }}"/>
<meta property="locale"
  content="{{ \Session::get('locale') }}" />
<meta property="og:locale:alternate" content="en_US">