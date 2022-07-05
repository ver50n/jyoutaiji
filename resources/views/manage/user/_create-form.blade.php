<section class="component__create-form">
  <form action="{{route($routePrefix.'.createPost')}}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label>@lang('common.name')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="name"
        value="{{old('name')}}"
        placeholder="@lang('common.name')" />
      <span class="c_form__error-block">{{$errors->first('name')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('common.username')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="username"
        value="{{old('username')}}"
        placeholder="@lang('common.username')" />
      <span class="c_form__error-block">{{$errors->first('username')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('common.is_navigator')</label>
      @php
        $oldValue = old('is_navigator') ? old('is_navigator') : 0;
      @endphp
      <select name="is_navigator"
        class="form-control input-sm col-2">
      @foreach(App\Helpers\ApplicationConstant::YES_NO as $key => $value)
        <option value="{{$key}}" {{ $oldValue == $key ? 'selected' : '' }}>
          @lang('application-constant.YES_NO.'.$value)
        </option>
      @endforeach
      </select>
    </div>
    
    <div>
      <button type="submit" class="btn btn-outline-primary">
        <span class="action-icon">
          <i class="c_icon fas fa-save menu-icon"></i> @lang('common.save')
        </span>
      </button>
    </div>
  </form>
</section>