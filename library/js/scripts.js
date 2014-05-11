(function($) {
  
  // Responsive Gravatar Images //
  var responsive_viewport = $(window).width();
  if (responsive_viewport > 640) {
    $('.comment img[data-gravatar]').each(function(){
      $(this).attr('src',$(this).attr('data-gravatar'));
    });
  } else {
    $('.comment img[data-gravatar]').hide();
  }
  
  // stores video aspect ratios for fluid resize //
  var all_videos = $('iframe[src*="//www.youtube.com"], iframe[src*="//player.vimeo.com"]');
  all_videos.each(function() {
    $(this).data('aspect_ratio', this.height / this.width).removeAttr('height').removeAttr('width');
  });
  
  $(window).resize(function() {
    
    // repaints specified elements //
    $('h1').css('z-index', 1);
  
    // fluid video width on resize //
    var vid_width = $('article').width();
    all_videos.each(function() {
      var el = $(this);
      el.width(vid_width).height(vid_width * el.data('aspect_ratio'));
    });
    
  }).resize();
  

  var get_header_heights = function() {
    var header_height   = $('#header').outerHeight(),
        admin_bar       = $('#wpadminbar').outerHeight() || 0,
        combined_height = header_height + admin_bar;
    return [header_height, admin_bar, combined_height];
  };
  
  
  // Need $(document).ready() in order to interact with admin bar //
  $(document).ready(function() {
    
    $('#sidebar').css({ top: get_header_heights()[2] });

    // Sidebar Behavior //
    $(window).scroll(function() {
    
      // No sidebar, skip it //
      if( $(window).width() > 900 ) {
      
        var scroll = $(window).scrollTop(),
            target = $('#sidebar'),
            all_header_heights = get_header_heights(),
            header_height = all_header_heights[0],
            admin_bar = all_header_heights[1],
            combined_height = all_header_heights[2];
            
        if ( scroll >= 0 && scroll < header_height ) {
          var top = combined_height - scroll;
          target.css({ top: top });
        } else if ( scroll >= header_height ) {
          target.css({ top: admin_bar });
        } else {
          target.css({ top: combined_height });
        }
      }
    }).scroll();
  
  });
  
  // Mobile Menu Control //
  $('a.menu-link').click(function() {
    
    $('#sidebar').css({ top: get_header_heights()[2] });
    $('nav#site-nav > ul').toggleClass('active');
    
  });
  
  // Desktop Menu Control //
  $('nav#site-nav li.menu-item-has-children > a').click(function(e) {
    e.preventDefault();
    var clicked = $(this).parent();
    if ( clicked.hasClass('active') ) {
      clicked.siblings().removeClass('inactive active');
      clicked.find('li').removeClass('inactive active');
      clicked.removeClass('active');
    } else {
      clicked.siblings().addClass('inactive').removeClass('active');
      clicked.siblings().find( $('li') ).removeClass('inactive active');
      clicked.removeClass('inactive').addClass('active');
    }
  });

  // Hides Mobile Menu on Unfocus //
  $(document).mouseup(function (e) {
    var container = $('nav#site-nav, .menu-link');
    if (!container.is(e.target) && container.has(e.target).length === 0) {
      $('nav#site-nav > ul').removeClass('active');
    }
  });

})(jQuery);
