<!-- Modal -->
<div class="modal fade"
  id="sitemap-modal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="sitemap-modal"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">@lang('common.sitemap')</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="sitemap-tree">
        </div>
        <h5>@lang('common.language-selection')</h5>
        @php
          $languages = \App\Helpers\ApplicationConstant::LANGUAGE;
        @endphp
        @foreach($languages as $key => $language)
        <div class="c_language-flag flag-change-locale" data="{{ $key }}">
          <div class="flag" style="background: url('{{ mix('/images/'.$key.'-flag.png') }}');">
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>