!function($){$.fn.set_theme_data=function(e,a,r){var t=$("#cssfile").val();t="theme."+t;var i=t.indexOf("[example]");i>1&&(t=t.replace("theme.",""));var l=t.replace("presets/theme.[example]-","");l=l.replace("theme.",""),$("#style-name").val(l),$("input#theme").val(l),$.getJSON("../"+r+"/settings/themes/"+t+".json?v="+a,function(e){if(e.settings){var a=function(e){var r={};for(var t in e)if(e.hasOwnProperty(t))if("object"==typeof e[t]){var i=a(e[t]);for(var l in i)i.hasOwnProperty(l)&&(r[l]=i[l])}else r[t]=e[t];return r};e=a(e)}$.each(e,function(e,a){var r="#"+e;if(a=a.replace("#",""),a=a.replace(/\"..\/..\/../g,"").replace(/"/g,""),""!==a&&$(r).not('[data-compile="layout"]').val(a).attr("data-stored",a),$(r).hasClass("zt-picker")){""==a&&(a=$(r).attr("data-default")),$(r).css({"border-color":"#"+a});var t=a.charAt(0);if("@"==t){var i=a.substring(1,a.length);i=$("input#"+i).val(),$(r).css({"border-right-color":"#"+i})}var t=a.substring(0,3);if("dar"==t||"lig"==t){if("dar"==t){var i=a.substring(8,a.length);i=i.split(",")}if("lig"==t){var i=a.substring(9,a.length);i=i.split(",")}var l=i[1].slice(0,-2);l=parseFloat(l)/100,"dar"==t&&(l="-"+l),i=i[0],i=$("input#"+i).val();var s=$(document).ColorLuminance(i,l);$(r).css({"border-right-color":s})}}if($(r).is(":checkbox")){var n=$(r).attr("id");$(r).val(""),1==a&&($("."+n).fadeIn().parent().fadeIn(),$(r).prop("checked","true").val(1)),(""==a||0==a)&&($("."+n).fadeOut().parent().fadeOut(),$(r).prop("checked",!1).val(0))}if($(r).is("select")&&(""==a?$(r+' option[value="inherit"]').attr("selected",1):$(r+' option[value="'+a+'"]').attr("selected",1)),"framework_version"==e&&($("#framework_version").val(a),$(".framework_list").removeClass("active"),$("#"+a).addClass("active")),"framework_files"==e){$("input.framework_files").removeAttr("checked").val(0);var o=a.split("_");console.log(o),$(o).each(function(){$('.active input[data-id="'+this+'"]').prop("checked","true").val(1)})}}),$(".border-rule").each(function(){var e=$(this),a=$(this).find(".border-widths-value").val();""!==a&&(a=a.split(" "),$(a).each(function(a,r){"0"!==r&&$(e).find('[data-key="'+a+'"]').addClass("active")}))}),$("#compile_required").val("0")})}}(jQuery);