<div class="c_sns-share">
  <div class="facebook">
    <div class=""
      data-href="https://developers.facebook.com/docs/plugins/"
      data-layout="button_count"
      data-size="small">
      <a target="_blank"
        href="https://www.facebook.com/sharer/sharer.php?u={{ $facebook['url'] }}&amp;src=sdkpreparse"
        class="fb-xfbml-parse-ignore"><i class="c_icon fab fa-facebook"></i></a>
    </div>
  </div>
  <div class="twitter">
    <a class="twitter-share-button"
      target="_blank"
      href="https://twitter.com/intent/tweet?text={{ $twitter['url'] }} - {{ $twitter['text'] }}"
      data-size="large"><i class="c_icon fab fa-twitter"></i></a>
  </div>

  <div class="line">
    <a class="line-share-button"
      target="_blank"
      href="https://social-plugins.line.me/lineit/share?text={{ $line['url'] }} - {{ $line['text'] }}"
      data-size="large"><i class="c_icon fab fa-line"></i></a>
  </div>
</div>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous"
  src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v5.0&appId=753679361693902&autoLogAppEvents=1"></script>