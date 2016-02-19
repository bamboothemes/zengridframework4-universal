(function ($) {
    $.fn.zenaccordion = function (options) {
    
    	// Accordion options
       var settings = $.extend({
               openfirst: false,
               openicon: 'angle-up',
               closeicon: 'angle-down',
               type: 'accordion'
       }, options);
     
       
      // Add the icons where necesary
      $('.zen-accordion li.parent span').append('<span class="zen-icon zen-icon-' + settings.closeicon + '"></span>');
      
      // Open First
      if(settings.openfirst) {
       		$(this).parent().parent().find('ul:first').slideDown().parent().addClass('open').find('.zen-icon').removeClass('zen-icon-'+ settings.closeicon).addClass('zen-icon-'+ settings.openicon);
      }
       
      $(document).on('click', '.zen-accordion > li.parent > span', function() {
           
           
           // Markup can define the type of accordion used but if none is specified 
           // we default to the Template setting
           if($(this).parent().parent().hasClass('zen-accordion-panel')) {
           		var type = "panel";
           } else if($(this).parent().parent().hasClass('zen-accordion')) {
           		var type = "accordion";
           } else {
           		var type = settings.type;
           }

           var menu = $(this).parent().parent();
           	
           if ($(this).parent().hasClass('open')){
           		
           		// User clicked on open parent
           		$(this).parent().removeClass('open').find('ul').slideUp();
           		
           		$(this).parent().find('.zen-icon').removeClass('zen-icon-'+ settings.openicon).addClass('zen-icon-'+ settings.closeicon);
           		
           } else {
            	
            	// User has clicked on a non-open parent
            	// Close all items
            	if(type == "accordion") {
            		$(menu).find('ul').slideUp();
            		
            		// Remove Active class
            		$(menu).find('li.parent').removeClass('open');
            		$(menu).find('.zen-icon').removeClass('zen-icon-'+ settings.openicon).addClass('zen-icon-'+ settings.closeicon);
            	}
            	
            	
            	// Make current active and open next ul
            	$(this).parent().addClass('open').find('ul').slideDown();
            	
            	// Change the icon
            	$(this).parent().find('.zen-icon').removeClass('zen-icon-'+ settings.closeicon).addClass('zen-icon-'+ settings.openicon);
           }
       }); 
    }
})(jQuery);