@php
  $default = '誠諦寺';
  $title = isset($title) ? $title : $default;
  $title .= ' - 誠諦寺';
@endphp
<title>{{ $title }}</title>