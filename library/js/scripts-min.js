jQuery(document).ready(function(){var e=jQuery(window).width();e>640?jQuery(".comment img[data-gravatar]").each(function(){jQuery(this).attr("src",jQuery(this).attr("data-gravatar"))}):jQuery(".comment img[data-gravatar]").hide();var t=jQuery('iframe[src*="//www.youtube.com"], iframe[src*="//player.vimeo.com"]');t.each(function(){jQuery(this).data("aspectRatio",this.height/this.width).removeAttr("height").removeAttr("width")}),jQuery(window).resize(function(){jQuery("h1").css("z-index",1);var e=jQuery("article").width();t.each(function(){var t=jQuery(this);t.width(e).height(e*t.data("aspectRatio"))})}).resize(),jQuery(".menu-link").click(function(){return jQuery("nav#site-nav > ul").toggleClass("active"),!1}),jQuery("nav#site-nav ul .menu-item-has-children").click(function(){jQuery(this).toggleClass("active")})});