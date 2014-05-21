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
    
  }).resize();
  

  /* Sidebar Behavior
  ========================== */
  
  // No sidebar, skip it //
  if( $(window).width() >= 900 ) {
  
    $(window).scroll(function() {
    
      var sidebar =        $('#sidebar'),
          header_height  = $('#header').outerHeight(),
          content_height = $('#content-container').outerHeight(),
          full_height = header_height + content_height - sidebar.outerHeight();
      
      // if the sidebar is taller than the content,
      // just position it relative
      if ( content_height <= sidebar.outerHeight() ) {
        sidebar.css({
          position: 'relative',
          top: 0
        });
        
      // otherwise, continue with normal scroll behavior
      } else {
        
        var scroll = $(window).scrollTop();
        
        sidebar.css({
          position: 'absolute'
        });
        
        if ( scroll >= full_height ) {
          sidebar.css({
            top:    'auto',
            bottom: 0
          });
        } else if ( scroll >= header_height ) {
          sidebar.css({
            top:    scroll - header_height,
            bottom: 'auto'
          });
        } else {
          sidebar.css({
            top: 0,
            bottom: 'auto'
          });
        }
      }
    }).scroll();
  
  }
  
  
  /* Mobile Menu Toggle
  ========================== */
  $('.menu-toggle').click(function(e) {
    
    e.preventDefault();
    $('#sidebar').toggleClass('active');
    
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
