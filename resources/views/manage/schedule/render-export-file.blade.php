@extends('layouts.manage-layout')
@section('content')
  <h4>スケジュールチラシプレビュー</h4>
	<div class="grid-action-wrapper">
		<div class="grid-action">
			<a href="{{route($routePrefix.'.list')}}">
				<button class="btn btn-outline-secondary">
		      <i class="c_icon fas fa-receipt menu-icon"></i> 一覧
				</button>
			</a>
		</div>
		<div class="grid-action">
			<a href="{{route($routePrefix.'.create')}}">
				<button class="btn btn-outline-secondary">
          <i class="c_icon fas fa-plus menu-icon"></i> 作成
				</button>
			</a>
		</div>
		<div class="grid-action">
			<a href="{{route($routePrefix.'.update', ['id' => $obj->id])}}">
				<button class="btn btn-outline-secondary">
          <i class="c_icon fas fa-edit menu-icon"></i> 変更
				</button>
			</a>
		</div>
		<div class="grid-action">
			<a href="{{route($routePrefix.'.view', ['id' => $obj->id])}}">
				<button class="btn btn-outline-secondary">
		      <i class="c_icon fas fa-eye menu-icon"></i> 観覧
				</button>
			</a>
		</div>
		<div class="grid-action">
			<a href="{{route($routePrefix.'.clone', ['id' => $obj->id])}}">
				<button class="btn btn-outline-secondary">
		      <i class="c_icon fas fa-copy menu-icon"></i> Clone
				</button>
			</a>
		</div>
		<div class="grid-action">
			<form action="{{route('helpers.activation')}}"
				id="grid-action-activation"
				method="POST">
				@csrf
        <input type="hidden" name="model" value="Schedule"/>
        <input type="hidden" name="id" value="{{$obj->id}}"/>
			</form>
      @if($obj->is_active == 0)
      <button class="btn btn-success"
        onClick="document.getElementById('grid-action-activation').submit()">
        <i class="c_icon fas fa-check menu-icon"></i> 有効にする
      </button>
      @else
      <button class="btn btn-danger"
        onClick="document.getElementById('grid-action-activation').submit()">
        <i class="c_icon fas fa-times menu-icon"></i> 無効にする
      </button>
      @endif
		</div>
		<div class="grid-action">
			<a href="{{route($routePrefix.'.render-export-file', ['id' => $obj->id])}}" target="_blank">
				<button class="btn btn-outline-secondary">
		      <i class="c_icon fas fa-scroll menu-icon"></i> チラシ生成
				</button>
			</a>
		</div>
	</div>
  <section class="card components__card-section-wrapper">
    <div class="card-header">
      <a data-toggle="collapse" href="#collapse-view__base-info"
        aria-expanded="true"
        aria-controls="collapse-view__base-info"
        id="view" class="d-block">
        <i class="c_icon fa fa-chevron-down pull-right"> 基本情報</i>
      </a>
    </div>
    <div id="collapse-view__base-info" class="collapse show">
      <div class="card-body">

		<div class="action-buttons">
			<a href="{{ route('manage.schedule.print-preview', ['id' => $obj->id]) }}" target="_blank">
				<button type="button" id="print" class="btn btn-primary">印刷</button>
			</a>
			<button type="button" id="downloadImage" class="btn btn-primary">画像 ダウンロード</button>
			<button type="button" id="downloadPdf" class="btn btn-primary">PDF ダウンロード</button>
			</a>
		</div>
        @include('pdf-layout.schedule-poster')
      </div>
    </div>
  </section>
@endsection

@section('javascript')
  <script type="text/javascript" src="https://unpkg.com/html2canvas@1.4.0/dist/html2canvas.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
  <script>
    var element = $("#a4");
    var getCanvas;

    $('document').ready(function() {
      convert = html2canvas(document.querySelector("#a4"));
      convert.then(canvas => {
        getCanvas = canvas.toDataURL('image/jpeg', 1.0);
      });

      function downloadPDF() {
        var doc = new jsPDF();

        doc.addImage(getCanvas, 'JPEG', 10, 10, 191, 270);
        doc.save('{{$obj->name}}');
      }
      function downloadImage() {
        var a = document.createElement('a');
        a.href = getCanvas;
        a.download = "{{$obj->name}}.jpg";
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);            
      }

      $('#downloadPdf').click(function () {
        downloadPDF();
      });
      $('#downloadImage').click(function () {
        downloadImage();
      });
    });
  </script>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => 'スケジュールチラシプレビュー'])
@endsection