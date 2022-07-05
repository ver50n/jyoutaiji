<!-- Modal -->
<div class="modal fade"
  id="language-selection-modal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="language-selection-modal"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">@lang('common.language-selection')</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
        <div class="language-selection">
          @php
            $languages = \App\Helpers\ApplicationConstant::LANGUAGE;
            $selected = Session::get('locale');
          @endphp

          <table style="width: 200px; margin: auto;">
          @foreach($languages as $key => $language)
            <tr>
              <td style="width: 100px;">
                <div class="c_language-flag flag-change-locale" data="{{ $key }}">
                  <div class="flag" style="background: url('{{ mix('/images/'.$key.'-flag.png') }}');">
                  </div>
                </div>
              </td>
            <td>
					  @lang('application-constant.LANGUAGE.'.$key)</td>
            </tr>
          @endforeach
</table>
        </div>
      </div>
    </div>
  </div>
</div>