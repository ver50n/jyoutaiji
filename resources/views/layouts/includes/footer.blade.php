
<div class="c_page-footer">
  <div class="subcontainer page-footer">
    <div class="text">
        あなたも幸せになりたいですか？
      <br />
      <a href="{{ route('pages.contact') }}" class="button-link">
        <div class="e_btn-type2" style="margin-top: 30px;">
          @lang('common.contact')
        </div>
      </a>
    </div>
  </div>
</div>
<footer class="footer">
  <div class="subcontainer footer__content">
    <div class="navigation">
      <div class="nav-group">
        <span class="nav-title">@lang('common.jyoutaiji-activity')</span>
          <ul>
            <li><a href="{{ route('pages.schedule') }}">@lang('common.schedule')</a></li>
            <li><a href="{{ route('pages.gallery') }}">@lang('common.gallery')</a></li>
          </ul>
        </span>
      </div>
      <div class="nav-group">
        <span class="nav-title">@lang('common.about-jyoutaiji')</span>
        <ul>
          <li><a href="{{ route('pages.about') }}">@lang('common.jyoutaiji')</a></li>
          <li><a href="{{ route('pages.contact') }}">@lang('common.contact')</a></li>
        </ul>
      </div>
      <div class="nav-group">
        <span class="nav-title">@lang('common.sns')</span>
        <ul>
          <li>
            <div class="sns-wrapper">
              <style>
                .sns-share-button {
                  margin: 5px !important;
                  margin-right: 0px !important;
                }
              </style>
              
              @include('components.sns-share-buttons',[
                'twitterUrl' => 'https://twitter.com/joutaiji_shibu',
                'fbUrl' => 'https://www.facebook.com/profile.php?id=100022037523880',
                'instagramUrl' => 'https://www.instagram.com/joutaiji_shibu/',
                'lineUrl' => 'http://line.me/ti/p/exaZu-yw23',
                'webUrl' => config('app.url')
              ])
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer__copy-right">
    All Right Reserved &copy; @lang('common.brand') {{ date('Y', strtotime(NOW())) }}
  </div>
</footer>