(function($) {

  
  /* Responsive Gravatar Images
  ============================== */
  var responsive_viewport = $(window).width();
  if (responsive_viewport > 640) {
    $('.comment img[data-gravatar]').each(function(){
      $(this).attr('src',$(this).attr('data-gravatar'));
    });
  } else {
    $('.comment img[data-gravatar]').hide();
  }
  
  
  /* Responsive Video Embeds
  ============================= */
  
  // stores video aspect ratios for fluid resize //
  // http://css-tricks.com/fluid-width-youtube-videos/ //
  var all_videos = $('iframe[src*="//www.youtube.com"], iframe[src*="//player.vimeo.com"]');
  all_videos.each(function() {
    $(this).data('aspect_ratio', this.height / this.width)
      .removeAttr('height')
      .removeAttr('width');
  });
  
  $(window).resize(function() {
    
    // fluid video width on resize //
    var vid_width = $('article').width();
    all_videos.each(function() {
      var el = $(this);
      el.width(vid_width).height(vid_width * el.data('aspect_ratio'));
    });
    
    
    /* Responsive Post-info
    ============================= */
    // calculates proper width to fit inside circle
    
    var cp_cats     = $('.cp-cats'),
        info_height = $('.post-info').outerHeight(),
        cat_height  = cp_cats.outerHeight(),
        r           = $('.post-thumbnail, .archive-thumbnail').width() / 2,
        d           = r - (info_height - cat_height),
        new_width   = 2 * Math.sqrt(r * r - d * d);
        
    cp_cats.width(new_width);
    
  }).resize();

  
  $(window).scroll(function() {
    
    /* Sidebar Behavior
    ========================== */
    
    // No sidebar, skip all this //
    if( $(window).width() >= 900 ) {
    
      var sidebar        = $('#site-nav'),
          admin_bar      = $('#wpadminbar').outerHeight() || 0,
          header_height  = $('#header').outerHeight(),
          content_height = $('#content-container').outerHeight(),
          full_height    = $('#footer').offset().top - sidebar.outerHeight() - admin_bar;
      
      // if the sidebar is taller than the content,
      // just position it relative
      if ( content_height <= sidebar.outerHeight() ) {
        sidebar.css({
          position: 'relative',
          top: 0
        });
        
      // otherwise, continue with normal scroll behavior
      } else {
        
        var scroll = $(this).scrollTop();
        
        if ( scroll >= full_height ) {
          sidebar.css({
            position: 'absolute',
            top:      full_height - header_height,
            left:     0,
            width:    '100%'
          });
        } else if ( scroll >= header_height ) {
          sidebar.css({
            position: 'fixed',
            top:      admin_bar,
            bottom:   'auto',
            left:     $('#sidebar').offset().left,
            width:    $('#sidebar').width(),
          });
        } else {
          sidebar.css({
            position: 'absolute',
            top:      0,
            bottom:   'auto',
            left:     0,
            width:    '100%'
          });
        }
      }
    }
  }).scroll();
  
  /* Mobile Menu Toggle
  ========================== */
  $('.menu-toggle').click(function(e) {
    
    e.preventDefault();
    $('#sidebar').toggleClass('active');
    $('#site-nav').css({
      position: 'relative',
      top: 0,
      left: 'auto'
    });
    
  });
  
  
  /* Desktop Menu Control
  ========================== */
  $('.menu .menu-item-has-children > a').click(function(e) {
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
    $(window).scroll();
  });


  /* Hides Mobile Menu on Unfocus
  ========================== */
  $(document).mouseup(function (e) {
    var container = $('#sidebar, .menu-toggle');
    if (!container.is(e.target) && container.has(e.target).length === 0) {
      $('nav#site-nav > ul').removeClass('active');
    }
  });

})(jQuery);
