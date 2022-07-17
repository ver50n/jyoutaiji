@extends('layouts.base-layout')

@section('content')
  <div class="container-wrapper gallery">
    <div class="subcontainer gallery-wrapper">
      <div class="navigator">
        <div id="category-tree"></div>
      </div>
      <div class="show">
        <div class="images">
          @foreach($galleries as $gallery)
          <div class="image">
            <a href="{{ \App\Utils\FileUtil::getImageUrl('gallery_thumbnail', $gallery->thumbnail) }}"
              class="thickbox">
              <img src="{{ \App\Utils\FileUtil::getImageUrl('gallery_thumbnail', $gallery->thumbnail) }}" alt="Alt" />
            </a> 
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection

@section('javascript')
  <script type="text/javascript" src="vendor/thick/thick.js"></script>
  <script>
    $(document).ready(function() {
      @php
        $children = [];
        foreach(\App\Models\Gallery::select('category')->groupby('category')->get() as $category) {
          $children[] = [
            'id' => $category->category,
            'text' => $category->category,
            'state' => ['opened' => true ],
            'a_attr' => [ 'href' => route('pages.gallery', ['filters[category]' => $category->category]) ] 
          ];
        }
      @endphp
      $('#category-tree').jstree({
      "core" : {
        "animation" : 0,
        "check_callback" : true,
        "themes" : { "stripes" : true },
        'data' : [
          {
            'id' : 'gallery',
            'text' : '@lang('common.gallery')',
            'state' : { 'opened' : true },
            'a_attr' : { 'href' : '{{ route('pages.gallery') }}' }, 
            'children' : {!! json_encode($children, JSON_UNESCAPED_UNICODE) !!}
          }
        ]
      },
    }).on('changed.jstree', function (e, data) {
        var href = data.node.a_attr.href;
        var parentId = data.node.a_attr.parent_id;
        if(href == '#')
        return '';
        window.location.href = href;
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
  <link href="{{mix('css/pages/gallery.css')}}" rel="stylesheet">
@endsection
