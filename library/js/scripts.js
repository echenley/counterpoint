jQuery(document).ready(function() {
  
  // Responsive Gravatar Images //
  var responsive_viewport = jQuery(window).width();
  if (responsive_viewport > 640) {
    jQuery('.comment img[data-gravatar]').each(function(){
      jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
    });
  }
  else {
    jQuery('.comment img[data-gravatar]').hide();
  }
  
  // stores video aspect ratios for fluid resize //
  var $allVideos = jQuery('iframe[src*="//www.youtube.com"], iframe[src*="//player.vimeo.com"]');
  $allVideos.each(function() {
    jQuery(this).data('aspectRatio', this.height / this.width).removeAttr('height').removeAttr('width');
  });
  
  jQuery(window).resize(function() {
    
    // repaints specified elements //
    jQuery('h1').css('z-index', 1);
  
    // fluid video width on resize //
    var vidWidth = jQuery('article').width();
    $allVideos.each(function() {
      var $el = jQuery(this);
      $el.width(vidWidth).height(vidWidth * $el.data('aspectRatio'));
    });
    
  }).resize();
  
  // Mobile Menu Control //
  jQuery('.menu-link').click(function() {
    jQuery('nav#site-nav > ul').toggleClass('active');
    return false;
  });
  
  jQuery('nav#site-nav').on('blur', function() {
    jQuery('nav#site-nav > ul').removeClass('active');
  });
  
  jQuery('nav#site-nav ul .menu-item-has-children').click(function() {
    jQuery(this).toggleClass('active');
  });

  // Hides Mobile Menu on Unfocus //
  jQuery(document).mouseup(function (e) {
    var container = jQuery('nav#site-nav');
    if (!container.is(e.target) && container.has(e.target).length === 0) {
      jQuery('ul', container).removeClass('active');
    }
  });
  
});

