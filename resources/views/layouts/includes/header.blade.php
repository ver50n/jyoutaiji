<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<link rel="icon" sizes="any" href="/images/svg-logo.svg" type="image/svg+xml">
<link rel="icon" sizes="any" href="/images/favicon.png" type="image/png">
<link rel="mask-icon" href="/images/favicon.png" color="black">

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
  integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
  crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{ asset('/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-157503343-1" defer async></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-157503343-1');
  
  $(function($) {
  	var changeLocale = function (locale) {
  		$.ajax({
  			url: '/helpers/change-locale',
  			data: {locale: locale},
  			headers: {
  				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  			},
  			method: 'POST',
  			success: function () {
  				location.reload();
  			}
  		});
  	}
    
    if(window.location.hash != "") {
      $('a[href="' + window.location.hash + '"]').click()
    }

    $('body').on('click', '.flag-change-locale', function() {
  		var locale = $(this).attr("data");
  		changeLocale(locale);
    });

    
    $('.go-top').click( function() {
      $('html,body').animate({ scrollTop: 0 }, 'slow');
    });
    $('.go-bottom').click( function() {
      $("html, body").animate({ scrollTop: $(document).height() }, 'slow');
    });
    $('#sitemap-tree').jstree({
      "core" : {
        "animation" : 0,
        "check_callback" : true,
        "themes" : { "stripes" : true },
        'data' : [
          {
            'id' : 'home',
            'text' : '@lang('common.home')',
            'state' : { 'opened' : true },
            'a_attr' : { 'href' : '{{ route('pages.home') }}' }, 
            'children' : [
              { 
                'id' : 'schedule',
                'text' : '@lang('common.schedule')',
                'state' : { 'opened' : true },
                'a_attr' : { 'href' : '{{ route('pages.schedule') }}' }, 
              },
              { 
                'id' : 'gallery',
                'text' : '@lang('common.gallery')',
                'state' : { 'opened' : true },
                'a_attr' : { 'href' : '{{ route('pages.gallery') }}' }, 
              },
              { 
                'id' : 'about',
                'text' : '@lang('common.about')',
                'state' : { 'opened' : true },
                'a_attr' : { 'href' : '{{ route('pages.about') }}' }, 
              },
              { 
                'id' : 'contact',
                'text' : '@lang('common.contact')',
                'state' : { 'opened' : true },
                'a_attr' : { 'href' : '{{ route('pages.contact') }}' }, 
              },
              { 
                'id' : 'announcement',
                'text' : '@lang('common.announcement')',
                'state' : { 'opened' : true },
                'a_attr' : { 'href' : '{{ route('pages.announcement') }}' }, 
              },
            ]
          }
        ]
      },
    }).on('changed.jstree', function (e, data) {
        var href = data.node.a_attr.href;
        var parentId = data.node.a_attr.parent_id;
        if(href == '#')
        return '';
        window.location.href = href;
    });
  });
</script>
@yield('javascript')
