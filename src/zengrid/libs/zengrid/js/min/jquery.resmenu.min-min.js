!function($,e,t){"use strict";$.fn.ReSmenu=function(n){function i(e,t,n){n=n||"",$(e).children("li").each(function(){var e=$(this).children("a").attr("href"),l=$(this).children("a").clone().children().remove().end().text();l+=$(this).children("span").clone().children().remove().end().text(),(void 0===e||e===!1||"#"===e||0===e.length)&&(e=""),$("<option/>",{value:e,html:n+l,disabled:e?!1:!0,selected:$(this).hasClass(s.activeClass)&&!s.selectOption?!0:!1}).appendTo("#mobile-menu-div select"),$(this).children("ul").length>0&&i($(this).children("ul"),t,n+"- ")})}function l(t,n){var l=$("<div/>",{"class":s.menuClass}).appendTo("none"),c=$("<select/>",{id:s.selectId+n}).appendTo(l);return $("#mobile-menu-div select").bind("change",function(){$(this).val().length>0&&(e.location.href=$(this).val())}),s.textBefore&&$("<label/>",{html:s.textBefore,"for":s.selectId+n}).prependTo(l),s.selectOption&&$("<option/>",{text:s.selectOption,value:""}).appendTo(c),i($(t),c),l}var s=$.extend({menuClass:"responsive_menu",selectId:"resmenu",textBefore:!1,selectOption:!1,activeClass:"active",maxWidth:480},n);this.each(function(){function n(){$(e).width()>parseInt(s.maxWidth,10)?($(i).show(),$("#menu ul ul").hide(),c&&$(c).hide()):($(i).hide(),c?$(c).show():c=l(i,t))}var i=$(this),c;t+=1,n(),$(e).resize(function(){n()})})}}(jQuery,this,0);