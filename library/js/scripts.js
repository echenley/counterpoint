(function($) {
  
  // Responsive Gravatar Images //
  var responsive_viewport = $(window).width();
  if (responsive_viewport > 640) {
    $('.comment img[data-gravatar]').each(function(){
      $(this).attr('src',$(this).attr('data-gravatar'));
    });
  }
  else {
    $('.comment img[data-gravatar]').hide();
  }
  
  // stores video aspect ratios for fluid resize //
  var $allVideos = $('iframe[src*="//www.youtube.com"], iframe[src*="//player.vimeo.com"]');
  $allVideos.each(function() {
    $(this).data('aspectRatio', this.height / this.width).removeAttr('height').removeAttr('width');
  });
  
  $(window).resize(function() {
    
    // repaints specified elements //
    $('h1').css('z-index', 1);
  
    // fluid video width on resize //
    var vidWidth = $('article').width();
    $allVideos.each(function() {
      var $el = $(this);
      $el.width(vidWidth).height(vidWidth * $el.data('aspectRatio'));
    });
    
  }).resize();
  
  // Mobile Menu Control //
  $('.menu-link').click(function() {
    $('nav#site-nav > ul').toggleClass('active');
    return false;
  });
  
  // Desktop Menu Control //
  $('nav#site-nav ul > .menu-item-has-children a').click(function() {
    $(this).parent().toggleClass('active');
  });

  // Hides Mobile Menu on Unfocus //
  $(document).mouseup(function (e) {
    var $container = $('nav#site-nav');
    if (!$container.is(e.target) && $container.has(e.target).length === 0) {
      $('> ul', $container).removeClass('active');
    }
  });

})(jQuery);
