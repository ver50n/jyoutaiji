<section class="component__update-form">
  <form action="{{route($routePrefix.'.updatePost', ['id' => $obj->id])}}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label>@lang('common.timeline_tag')</label> <span class="e_required">*</span>
      <input class="form-control input-sm"
        name="timeline_tag"
        value="{{old('timeline_tag') ? old('timeline_tag') : $obj->timeline_tag}}"
        placeholder="@lang('common.timeline_tag')" />
      <span class="c_form__error-block">{{$errors->first('timeline_tag')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('common.event_tag')</label> <span class="e_required">*</span>
      <input class="form-control input-sm"
        name="event_tag"
        value="{{old('event_tag') ? old('event_tag') : $obj->event_tag}}"
        placeholder="@lang('common.event_tag')" />
      <span class="c_form__error-block">{{$errors->first('event_tag')}}</span>
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