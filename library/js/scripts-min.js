!function(t){var e=t(window).width();e>640?t(".comment img[data-gravatar]").each(function(){t(this).attr("src",t(this).attr("data-gravatar"))}):t(".comment img[data-gravatar]").hide();var a=t('iframe[src*="//www.youtube.com"], iframe[src*="//player.vimeo.com"]');a.each(function(){t(this).data("aspect_ratio",this.height/this.width).removeAttr("height").removeAttr("width")}),t(window).resize(function(){var e=t(".post-header").width()/2.618;t(".post-header").css({height:e+"px"});var i=t("article").width();a.each(function(){var e=t(this);e.width(i).height(i*e.data("aspect_ratio"))})}).resize();var i=function(){var e=t("#header").outerHeight(),a=t("#wpadminbar").outerHeight()||0,i=e+a;return[e,a,i]};t(document).ready(function(){t("#sidebar").css({top:i()[2]}),t(window).scroll(function(){if(t(window).width()>900){var e=t(window).scrollTop(),a=t("#sidebar"),s=i(),r=s[0],n=s[1],c=s[2];if(e>=0&&r>e){var o=c-e;a.css({top:o})}else a.css(e>=r?{top:n}:{top:c})}}).scroll()}),t(".menu-toggle").click(function(){t("#sidebar").css({top:i()[2]}),t(".menu").toggleClass("active")}),t(".menu .menu-item-has-children > a").click(function(e){e.preventDefault();var a=t(this).parent();a.hasClass("active")?(a.siblings().removeClass("inactive active"),a.find("li").removeClass("inactive active"),a.removeClass("active")):(a.siblings().addClass("inactive").removeClass("active"),a.siblings().find(t("li")).removeClass("inactive active"),a.removeClass("inactive").addClass("active"))}),t(document).mouseup(function(e){var a=t("nav#site-nav, .menu-toggle");a.is(e.target)||0!==a.has(e.target).length||t("nav#site-nav > ul").removeClass("active")})}(jQuery);