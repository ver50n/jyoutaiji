@extends('layouts.base-layout')

@section('content')
  <div class="container-wrapper gallery">

    <div class="subcontainer slider-wrapper">
      <div class="slider">
        @foreach($sliders as $slider)
        <div class="item">
          <img src="{{ \App\Utils\FileUtil::getImageUrl('gallery_thumbnail', $slider->thumbnail) }}" alt="alt" style="width: 100%;" />
        </div>
        @endforeach
      </div>
    </div>

    <div class="subcontainer images-wrapper">
      <div class="images">
        @foreach($galleries as $gallery)
        <div class="image">
          <a href="{{ \App\Utils\FileUtil::getImageUrl('gallery_thumbnail', $gallery->thumbnail) }}"
            title=""
            class="thickbox">
            <img src="{{ \App\Utils\FileUtil::getImageUrl('gallery_thumbnail', $gallery->thumbnail) }}"
              width="300" alt="Alt" />
          </a> 
        </div>
        @endforeach
      </div>

    </div>
  </div>
@endsection

@section('javascript')
  <script type="text/javascript" src="vendor/thick/thick.js"></script>
  <script type="text/javascript" src="vendor/slick/slick.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.slider').slick({
        autoplay: true,
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: true,
        prevArrow: '',
        nextArrow: ''
      });
    })
  </script>
@endsection

@section('meta')
@include('layouts.includes.meta', [
  'url' => route('pages.gallery'),
  'title' => trans('common.gallery')
])
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => trans('common.gallery')])
@endsection

@section('stylesheet')
  <link rel="stylesheet" href="vendor/thick/thick.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="vendor/slick/slick.css" type="text/css" media="screen" />
  <style>
    .images {
      display: flex;
      flex-direction: row;
      flex-wrap: wrap;
      justify-content: center;
    }
    .image {
      width: 300px;
      margin-top: 10px;
      margin-right: 10px;
    }
  </style>
@endsection
