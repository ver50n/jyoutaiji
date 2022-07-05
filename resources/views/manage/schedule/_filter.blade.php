<section class="component__filter-form">
  <button type="button"
    class="btn btn-outline-secondary"
    data-toggle="modal"
    data-target="#filter-popup">
    <span class="action-icon">
      <i class="c_icon fas fa-filter menu-icon"></i> フィルター
    </span>
  </button>
  <div class="modal fade" id="filter-popup"
    tabindex="-1"
    role="dialog"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card">
          <div class="card-header"><i class="c_icon fas fa-filter menu-icon"></i> フィルター</div>
          <div class="card-body">
            <form action="{{route($routePrefix.'.list')}}" method="GET">
              <div class="form-group">
                <label>@lang('common.name')</label>
                <input class="form-control input-sm"
                  name="filters[name]"
                  value="{{$obj->name}}"
                  autocomplete="off" />
              </div>
              <div class="form-group">
                <label>@lang('common.type')</label>
                @php
                  $oldValue = old('type') ? old('type') : $obj->type;
                @endphp
                <select name="filters[type]"
                  class="form-control input-sm">
                  <option value=""></option>
                @foreach(App\Helpers\ApplicationConstant::SCHEDULE_TYPE as $key => $value)
                  <option value="{{$key}}" {{ $oldValue == $key ? 'selected' : '' }}>
                    {{ $value }}
                  </option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>@lang('common.category')</label>
                @php
                  $oldValue = old('category') ? old('category') : $obj->category;
                @endphp
                <select name="filters[category]"
                  class="form-control input-sm">
                  <option value=""></option>
                @foreach(\App\Helpers\ApplicationConstant::SCHEDULE_CATEGORY as $key => $value)
                  <option value="{{$key}}" {{ $oldValue == $key ? 'selected' : '' }}>
                    @lang('application-constant.SCHEDULE_CATEGORY.'.$value)
                  </option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>@lang('common.start_at')</label>

                <div class="form-row">
                  <div class="col-md-4 mb-3">
                    <input class="form-control form-control-sm"
                      name="filters[start_at_start]"
                      id="start_at_start"
                      value="{{old('start_at_start') ? old('start_at_start') : $obj->start_at_start}}" />
                  </div>
                  <div class="col-md-4 mb-3">
                    <input class="form-control form-control-sm"
                      name="filters[start_at_end]"
                      id="start_at_end"
                      value="{{old('start_at_end') ? old('start_at_end') : $obj->start_at_end}}" />
                  </div>
                </div>
              </div>
              <div>
                <button type="submit" class="btn btn-success">
                  <span class="action-icon">
                    <i class="c_icon fas fa-filter menu-icon"></i> フィルター
                  </span>
                </button>
                <a href="{{route($routePrefix.'.list')}}">
                  <button type="button" class="btn btn-outline-secondary reset-filter">
                    <span class="action-icon">
                      <i class="c_icon fas fa-sync-alt menu-icon"></i> リセット
                    </span>
                  </button>
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>