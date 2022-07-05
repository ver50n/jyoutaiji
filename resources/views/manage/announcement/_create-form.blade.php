<section class="component__update-form">
  <form action="{{route($routePrefix.'.createPost')}}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label>@lang('common.content')</label> <span class="e_required">*</span>
      <input class="form-control input-sm"
        name="content"
        value="{{old('content')}}"
        placeholder="@lang('common.content')" />
      <span class="c_form__error-block">{{$errors->first('content')}}</span>
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