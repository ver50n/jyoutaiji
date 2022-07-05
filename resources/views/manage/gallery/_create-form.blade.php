<section class="component__update-form">
  <form action="{{route($routePrefix.'.createPost')}}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label>@lang('common.title')</label>
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
      <label>@lang('common.is_slider')</label>
      @php
        $oldValue = old('is_slider') ? old('is_slider') : 0;
      @endphp
      <select name="is_slider"
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
</section>