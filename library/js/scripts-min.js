!function(e){var t=e(window).width();t>640?e(".comment img[data-gravatar]").each(function(){e(this).attr("src",e(this).attr("data-gravatar"))}):e(".comment img[data-gravatar]").hide();var a=e('iframe[src*="//www.youtube.com"], iframe[src*="//player.vimeo.com"]');a.each(function(){e(this).data("aspect_ratio",this.height/this.width).removeAttr("height").removeAttr("width")}),e(window).resize(function(){var t=e("article").width();a.each(function(){var a=e(this);a.width(t).height(t*a.data("aspect_ratio"))})}).resize();var i=function(){var t=e("#header").outerHeight(),a=e("#wpadminbar").outerHeight()||0,i=t+a;return[t,a,i]};e(document).ready(function(){e("#sidebar").css({top:i()[2]}),e(window).scroll(function(){if(e(window).width()>=900){var t=e(window).scrollTop(),a=e("#sidebar"),s=i(),r=s[0],n=s[1],c=s[2];if(t>=0&&r>t){var o=c-t;a.css({top:o})}else a.css(t>=r?{top:n}:{top:c})}else e("#sidebar").css({top:i()[0]})}).scroll()}),e(".menu-toggle").click(function(t){t.preventDefault(),e("#sidebar").css({top:i()[0]}),e("#sidebar").toggleClass("active")}),e(".menu .menu-item-has-children > a").click(function(t){t.preventDefault();var a=e(this).parent();a.hasClass("active")?(a.siblings().removeClass("inactive active"),a.find("li").removeClass("inactive active"),a.removeClass("active")):(a.siblings().addClass("inactive").removeClass("active"),a.siblings().find(e("li")).removeClass("inactive active"),a.removeClass("inactive").addClass("active"))}),e(document).mouseup(function(t){var a=e("#sidebar, .menu-toggle");a.is(t.target)||0!==a.has(t.target).length||e("nav#site-nav > ul").removeClass("active")})}(jQuery);