jQuery(document).ready(function($){$("#menu .menu-item-has-children").addClass("deeper parent"),$("#menu.zen-menu-fading ul li.parent").hover(function(){$(this).children("ul").fadeIn("fast")},function(){$(this).children("ul").fadeOut("fast")}),$(".zen-menu-horizontal li.parent").not(".justify").on("mouseenter mouseleave",function(){var e=$(this).index();$(".zen-menu-horizontal li").removeClass("zen-menu-offscreen"),$("html").hasClass("touch")||$("body").offscreen_check(e)}),Modernizr.touch&&(jQuery("li.parent > a").click(function(e){jQuery(this).closest("li.parent").hasClass("open")||(e.preventDefault(),jQuery(this).closest("li.parent").addClass("open"))}),jQuery("body").click(function(e){jQuery(e.target).is("li.parent > a")||jQuery(".zen-menu li.parent").removeClass("open")})),$(".pager li").each(function(e,n){if(0==$(this).find("a").length){var t=$(this).html();$(this).html('<a href="#" class="btn disabled">'+t+"</a>")}}),$(document).on("click",".pager a.disabled",function(){return!1}),$(document).on("click",".zen-nav-tabs li",function(){$(this).parent().find("li").removeClass("active"),$(this).addClass("active");var e=$(this).attr("data-target");return $(this).parent().next(".zen-tab-content").find(".zen-tab-pane").hide(),$(this).parent().next(".zen-tab-content").find('[data-id="'+e+'"]').fadeIn(),!1}),$(".zen-slide-content.open").slideDown(),$(document).on("click",".zen-slide-trigger",function(){return $(this).next(".zen-slide-content").slideToggle(),!1}),$(document).on("click",".zen-modal-trigger",function(){var e=$(this).attr("data-target"),n=$('[data-id="'+e+'"]').html();return $("#modal-place-holder").html(n),$("#modal-place-holder,.zen-modal-overlay").fadeToggle().addClass("active"),!1}),$(document).on("click",".zen-modal-overlay,.zen-modal-close",function(){return $(".zen-modal.active,.zen-modal-overlay").fadeToggle().removeClass("active"),$("#modal-place-holder").html(""),!1}),$(".zen-scroll-top").click(function(){return $("html, body").animate({scrollTop:0},"slow"),!1}),$(".zen-scroll-bottom").click(function(){return $("html, body").animate({scrollTop:$(document).height()},"slow"),!1}),$(window).scroll(function(){$(this).scrollTop()>200?$(".zen-scroll-fade").fadeIn():$(".zen-scroll-fade").fadeOut()}),$('[data-dismiss="alert"]').click(function(){$(this).parent().fadeOut()})}),function($){$.fn.offscreen_check=function(e){var e=e+1,n=$(".zen-menu-horizontal li:nth-child("+e+") ul:first",this),t=n.offset(),a=t.left,l=n.width()+50,i=$(window).height(),o=$(window).width(),s=o>=a+l;s?$(this).parent().removeClass("zen-menu-offscreen"):$(".zen-menu-horizontal li:nth-child("+e+")").addClass("zen-menu-offscreen")},$.fn.append_nav=function(e){var n="#off-canvas-menu",t=$(window).width();if(e>t&&!$(n+" ul").hasClass("simple-list")){var a=$("#menu ul").html();$(n+" ul").append(a).addClass("simple-list").parent().addClass("accordion")}}}(jQuery);