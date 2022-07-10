(function($){
	$(document).ready(function () {
		$(window).scroll(function() {
			  if ($(this).scrollTop() > 110){  
                jQuery('#masthead').addClass('sticky');
                jQuery('.thats-why-items').css({
                    marginBottom: '130px'
                });
			  }
			  else if($(this).scrollTop() < 115) {
                jQuery('#masthead').removeClass("sticky");
                jQuery('.thats-why-items').css({
                    marginBottom: '0'
                });
			  }
        });
	});
})(jQuery);