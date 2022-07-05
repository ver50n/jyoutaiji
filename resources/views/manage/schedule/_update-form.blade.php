<section class="component__update-form">
  <form action="{{route($routePrefix.'.updatePost', ['id' => $obj->id])}}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-6">
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
              <div class="form-group">
                <label>@lang('common.type')</label> <span class="e_required">*</span>
                @php
                  $oldValue = old('type') ? old('type') : $obj->type;
                @endphp
                <select name="type"
                  class="form-control input-sm">
                @foreach(App\Helpers\ApplicationConstant::SCHEDULE_TYPE as $key => $value)
                  <option value="{{$key}}" {{ $oldValue == $key ? 'selected' : '' }}>
                    {{ $value }}
                  </option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>@lang('common.category')</label> <span class="e_required">*</span>
                @php
                  $oldValue = old('category') ? old('category') : $obj->category;
                @endphp
                <select name="category"
                  class="form-control input-sm">
                @foreach(\App\Helpers\ApplicationConstant::SCHEDULE_CATEGORY as $key => $value)
                  <option value="{{$key}}" {{ $oldValue == $key ? 'selected' : '' }}>
                    @lang('application-constant.SCHEDULE_CATEGORY.'.$value)
                  </option>
                @endforeach
                </select>
              </div>              
              <div class="form-group">
                <label>@lang('common.navigator')</label> <span class="e_required">*</span>
                @php
                  $oldValue = old('navigator') ? old('navigator') : $obj->navigator;
                @endphp
                <select name="navigator"
                  class="form-control input-sm">
                @foreach(\App\Models\User::getNavigators() as $key => $value)
                  <option value="{{$key}}" {{ $oldValue == $key ? 'selected' : '' }}>
                    {{ $value }}
                  </option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>@lang('common.name')</label> <span class="e_required">*</span>
                <input class="form-control input-sm"
                  name="name"
                  value="{{old('name') ? old('name') : $obj->name}}"
                  placeholder="@lang('common.name')" />
                <span class="c_form__error-block">{{$errors->first('name')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.cost')</label>
                <input class="form-control input-sm"
                  name="cost"
                  value="{{old('cost') ? old('cost') : $obj->cost}}"
                  placeholder="@lang('common.cost')" />
                <span class="c_form__error-block">{{$errors->first('cost')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.participant_limit')</label>
                <input class="form-control input-sm"
                  name="participant_limit"
                  value="{{old('participant_limit') ? old('participant_limit') : $obj->participant_limit}}"
                  placeholder="@lang('common.participant_limit')" />
                <span class="c_form__error-block">{{$errors->first('participant_limit')}}</span>
              </div>
            </div>
          </div>
        </section>
      </div>
      <div class="col-6">
        <section class="card components__card-section-wrapper">
          <div class="card-header">
            <a data-toggle="collapse" href="#collapse-view__additional-info"
              aria-expanded="true"
              aria-controls="collapse-view__additional-info"
              id="view" class="d-block">
              <i class="c_icon fa fa-chevron-down pull-right"> 追加情報</i>
            </a>
          </div>
          <div id="collapse-view__additional-info" class="collapse show">
            <div class="card-body">
              <div class="form-group">
                <label>@lang('common.short_desc')</label> <span class="e_required">*</span>
                <input class="form-control input-sm"
                  name="short_desc"
                  value="{{old('short_desc') ? old('short_desc') : $obj->short_desc}}"
                  placeholder="@lang('common.short_desc')" />
                <small class="form-text text-muted">スケジュールのショート説明</small>
                <span class="c_form__error-block">{{$errors->first('short_desc')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.desc')</label>
                <textarea class="form-control input-sm"
                  name="desc"
                  placeholder="@lang('common.desc')">{{old('desc') ? old('desc') : $obj->desc}}</textarea>
                <small class="form-text text-muted">ルール、持参事、注意事、など</small>
                <span class="c_form__error-block">{{$errors->first('desc')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.location')</label> <span class="e_required">*</span>
                <textarea class="form-control input-sm"
                  name="location"
                  placeholder="@lang('common.location')">{{old('location') ? old('location') : $obj->location}}</textarea>
                <span class="c_form__error-block">{{$errors->first('location')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.start_at')</label> <span class="e_required">*</span>
                <input class="form-control input-sm"
                  name="start_at"
                  value="{{old('start_at') ? old('start_at') : $obj->start_at}}"
                  placeholder="@lang('common.start_at')" />
                <span class="c_form__error-block">{{$errors->first('start_at')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.end_at')</label>
                <input class="form-control input-sm"
                  name="end_at"
                  value="{{old('end_at') ? old('end_at') : $obj->end_at}}"
                  placeholder="@lang('common.end_at')" />
                <span class="c_form__error-block">{{$errors->first('end_at')}}</span>
              </div>
              
              <div class="form-group">
                <label>@lang('common.is_for_member_only')</label>
                @php
                  $oldValue = old('is_for_member_only') ? old('is_for_member_only') : $obj->is_for_member_only;
                @endphp
                <select name="is_for_member_only"
                  class="form-control input-sm col-2">
                @foreach(App\Helpers\ApplicationConstant::YES_NO as $key => $value)
                  <option value="{{$key}}" {{ $oldValue == $key ? 'selected' : '' }}>
                    @lang('application-constant.YES_NO.'.$value)
                  </option>
                @endforeach
                </select>
              </div>
              
              <div class="form-group">
                <label>@lang('common.is_auto_approve')</label>
                @php
                  $oldValue = old('is_auto_approve') ? old('is_auto_approve') : $obj->is_auto_approve;
                @endphp
                <select name="is_auto_approve"
                  class="form-control input-sm col-2">
                @foreach(App\Helpers\ApplicationConstant::YES_NO as $key => $value)
                  <option value="{{$key}}" {{ $oldValue == $key ? 'selected' : '' }}>
                    @lang('application-constant.YES_NO.'.$value)
                  </option>
                @endforeach
                </select>
              </div>
            </div>
          </div>
        </section>
      </div>
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
