<section class="component__gallery-upload-form">
  <form action="{{route($routePrefix.'.uploadGalleryPost', ['id' => $obj->id])}}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="category" value="{{ $obj->category_cd }}" />
    <div class="form-group">
      <label>@lang('common.title')</label> <span class="e_required">*</span>
      <input class="form-control input-sm"
        name="title"
        value="{{old('title')}}"
        placeholder="@lang('common.title')" />
      <span class="c_form__error-block">{{$errors->first('title')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('common.thumbnail')</label> <span class="e_required">*</span>
      <input class="form-control input-sm"
        type="file"
        name="thumbnail"
        placeholder="@lang('common.thumbnail')" />
      <span class="c_form__error-block">{{$errors->first('thumbnail')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('common.is_active')</label>
      @php
        $oldValue = old('is_active');
      @endphp
      <select name="is_active"
        class="form-control input-sm col-2">
      @foreach(App\Helpers\ApplicationConstant::YES_NO as $key => $value)
        <option value="{{$key}}" {{ $oldValue == $key ? 'selected' : '' }}>
          @lang('application-constant.YES_NO.'.$value)
        </option>
      @endforeach
      </select>
    </div>
    <div>
      <button type="submit" class="btn btn-primary">
        <span class="action-icon">
          <i class="c_icon fas fa-save menu-icon"></i> 保存
        </span>
      </button>
    </div>
  </form>
  <br />
  <table class="grid-table table table-striped table-bordered table-responsive-sm">
    <thead>
      <th>@lang('common.title')</th>
      <th>@lang('common.thumbnail')</th>
      <th>@lang('common.is_active')</th>
      <th>@lang('common.action')</th>
    </thead>
    <tbody class="gallery-info">
      @foreach($obj->galleries as $gallery)
      <tr>
        <td>
          <div class="form-group">
            <form action="{{route($routePrefix.'.updateGalleryPost', ['id' => $obj->id])}}"
              method="POST"
              enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id" value="{{ $gallery->id }}" />
              <input class="form-control form-control-sm title"
                name="title"
                value="{{old('title') ? old('title') : $gallery->title}}"
                placeholder="@lang('common.title')" /><br />
              
              <button type="submit" class="btn btn-primary">
                <span class="action-icon">
                  <i class="c_icon fas fa-save menu-icon"></i> 保存
                </span>
              </button>
            </form>
            <span class="c_form__error-block">{{$errors->first('title')}}</span>
          </div>
        </td>
        <td>
          <div class="form-group">
            <img src="{{ \App\Utils\FileUtil::getImageUrl('gallery_thumbnail', $gallery->thumbnail) }}" width="300" />
            <span class="c_form__error-block">{{$errors->first('thumbnail')}}</span>
          </div>
        </td>
        <td>
          <form action="{{route('helpers.activation')}}"
            id="grid-action-activation-{{$gallery->id}}"
            method="POST"
          >
            @csrf
            <input type="hidden" name="model" value="Gallery"/>
            <input type="hidden" name="id" value="{{$gallery->id}}"/>
          </form>
          @if($gallery->is_active == 0)
          <button class="btn btn-success"
            onClick="document.getElementById('grid-action-activation-{{$gallery->id}}').submit()">
            <i class="c_icon fas fa-check menu-icon"></i> 有効にする
          </button>
          @else
          <button class="btn btn-danger"
            onClick="document.getElementById('grid-action-activation-{{$gallery->id}}').submit()">
            <i class="c_icon fas fa-times menu-icon"></i> 無効にする
          </button>
          @endif
        </td>
        <td>
          <div class="icon-wrapper">
            <a href="{{ route($routePrefix.'.deleteGallery', ['id' => $gallery->id]) }}">
            <span class="action-icon">
              <i class="c_icon icon fas fa-trash menu-icon" title="remove"></i>
            </span>
            </a>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</section>