<section class="c_sns-share-button">
  
  @if(isset($fbUrl))
  <div class="sns-share-button">
    <a href="{{ $fbUrl }}"
      target="_blank"
      rel="noopener">
      <i class="c_icon fab fa-facebook"></i>
    </a>
  </div>
  @endif

  @if(isset($twitterUrl))
  <div class="sns-share-button">
    <a href="{{ $twitterUrl }}"
      target="_blank"
      rel="noopener">
      <i class="c_icon fab fa-twitter"></i>
    </a>
  </div>
  @endif

  @if(isset($instagramUrl))
  <div class="sns-share-button">
    <a href="{{ $instagramUrl }}"
      target="_blank"
      rel="noopener">
      <i class="c_icon fab fa-instagram"></i>
    </a>
  </div>
  @endif

  @if(isset($lineUrl))
  <div class="sns-share-button">
    <a href="{{ $lineUrl }}"
      target="_blank"
      rel="noopener">
      <i class="c_icon fab fa-line"></i>
    </a>
  </div>
  @endif

  @if(isset($webUrl))
  <div class="sns-share-button">
    <a href="{{ $webUrl }}"
      target="_blank"
      rel="noopener">
      <i class="c_icon fas fa-globe"></i>
    </a>
  </div>
  @endif
</section>
