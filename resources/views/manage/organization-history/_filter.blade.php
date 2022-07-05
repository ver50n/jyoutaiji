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
                <label>@lang('common.id')</label>
                <input class="form-control input-sm"
                  name="filters[id]"
                  value="{{$obj->id}}"
                  autocomplete="off" />
              </div>
              <div class="form-group">
                <label>@lang('common.timeline_tag')</label>
                <input class="form-control input-sm"
                  name="filters[timeline_tag]"
                  value="{{$obj->timeline_tag}}"
                  autocomplete="off" />
              </div>
              <div class="form-group">
                <label>@lang('common.event_tag')</label>
                <input class="form-control input-sm"
                  name="filters[event_tag]"
                  value="{{$obj->event_tag}}"
                  autocomplete="off" />
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