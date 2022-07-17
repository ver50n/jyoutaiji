<section class="component__update-form">
  <form action="{{route($routePrefix.'.createPost')}}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label>@lang('common.category_cd')</label> <span class="e_required">*</span>
      <input class="form-control input-sm"
        name="category_cd"
        value="{{old('category_cd')}}"
        placeholder="@lang('common.category_cd')" />
      <span class="c_form__error-block">{{$errors->first('category_cd')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('common.name')</label> <span class="e_required">*</span>
      <input class="form-control input-sm"
        name="name"
        value="{{old('name')}}"
        placeholder="@lang('common.name')" />
      <span class="c_form__error-block">{{$errors->first('name')}}</span>
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