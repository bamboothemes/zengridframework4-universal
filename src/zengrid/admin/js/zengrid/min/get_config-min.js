!function($){$.fn.get_config=function(){config={},config.params={},config.params.theme=$("select#cssfile").val(),$('[data-compile="both"],[data-compile="config"]').not(".zt-picker").not(".exclude").each(function(i){id=$(this).attr("id"),"undefined"!=typeof id&&($(this).is("select")?value=$("select#"+id).val():(value=$(this).val(),"on"==value&&(value="1")),config.params[id]=value)}),config.params.socialicons={},$("#extra-social-networks li").each(function(i){var t=$(this).find("input").val(),a=$(this).find("select").val();""!==t&&(config.params.socialicons[t]=a,settings+=JSON.stringify(t)+":"+JSON.stringify(a))}),config.layout={};var i=$(document).get_layout();return config.layout=i,config}}(jQuery);