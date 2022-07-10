(function ($) {
    $( document ).on( 'click', '.btn-filter', function(e) {
        var _this = $(this);
        var slug = '';
        var is_selected = false;
        var type = $(this).data('filter');
        var action = '';
		var loading_html = '<div class="loading-overlay"><img class="loading-img" src="/wp-content/themes/storefront-child/images/loading.gif" width=50/></div>';

        is_selected = toggleCategoryButton(_this);
        if(is_selected) {
            slug = _this.data('slug');
        }
        
        if ( type == 'category' ) {
            action = 'filter_products_by_category';
        } else if ( type == 'tag' ) {
            action = 'filter_products_by_tag';
        }

        var admin_ajax_url = $('#admin_ajax_url').val();
        var data = {
            action: action,
            slug: slug,
        };
		setTimeout(function(){
			$.ajax({
				type: 'post',
				url: admin_ajax_url,
				data: data,
				beforeSend: function() {
					$('.products-wrapper').append(loading_html);
				},
				complete: function() {
					$('.loading-overlay').remove();
				},
				success: function (response) {
					var output = '';
					var res = JSON.parse(response);
					if(res.length) {
						res.forEach(product => {
							var li_classes = 'product type-product product-type-simple ';
							var cart_style = '';
							li_classes += ' post-' + product['data']['ID'];
							if(product['out_of_stock'] == 1) {
								cart_style = 'style="pointer-events: none; opacity: 0.4;"';
							}
							var list_cotent = '<li class="' + li_classes + '"><div class="card card-product pop-and-glow">';
							var card_image = '<div class="card-image"><a href="'+ product['url'] +'" title="'+ product['data']['post_title'] +'"><img width="230" height="350" src="'+ product['image'] +'" class="woocommerce-placeholder wp-post-image" alt="Placeholder" loading="lazy"></a><div class="ripple-container"></div></div>';
							var card_content = '<div class="content">'+ product['categories'] 
								+'<h4 class="card-title"><a href="'+ product['url'] +'">'+ product['data']['post_title'] +'</a></h4>'
								+ '<div class="footer"><div class="price"><h4>'+ product['price'] +'</h4></div><div class="stats"><a rel="nofollow" href="?add-to-cart='+ product['data']['ID'] +'" class="button product_type_simple add_to_cart_button ajax_add_to_cart btn btn-just-icon btn-simple btn-default" data-quantity="1" data-product_id="'+ product['data']['ID'] +'" data-product_sku="" '+ cart_style +'></a></div></div></div>';

							list_cotent = list_cotent + card_image + card_content + '</div></li>';

							output += list_cotent;
						});
					}else{
						output = '<li><p class="woocommerce-info">No products were found matching your selection.</p></li>';
					}

					$('ul.products').html(output);
				},
			});
		}, 300);
    });

    function toggleCategoryButton(element) {
        var selected = element.hasClass('selected');
        $('.btn-filter').removeClass('selected');
        if(!selected) {
            element.addClass('selected');
            return true;
        }
        return false;
    }
	
	$(document).on('mouseenter', '.sort-by-type .ubermenu-submenu .ubermenu-tab.ubermenu-item a', function() {
		var _this = $(this);
		setTimeout(function() {
			if(!_this.parent().hasClass('ubermenu-active')) {
				_this.parent().addClass('ubermenu-active');
			}
			_this.parent().siblings().removeClass('ubermenu-active');
		}, 200);
	});
	
	$(document).mouseup(function(e) {
		var container = $(".delivery-time-container");

		// if the target of the click isn't the container nor a descendant of the container
		if (!container.is(e.target) && container.has(e.target).length === 0) 
		{
			setTimeout(function() {
				container.removeClass('open');
			}, 100);
		}
	});
	
	$( document ).on('click', '.delivery-time', function(e) {
		if($('.delivery-time-container').hasClass('open')) {
			setTimeout(function() {
				$('.delivery-time-container').removeClass('open');
			}, 100);
		}else{
			$('.delivery-time-container').addClass('open');
			
		}
	});
	
	$( document ).on('click', '.filter-wrapper .tab .tablinks', function(e) {
	    var _this = $(this);
	    var tab_num = _this.data('tab');
	    setTimeout(function() {
    	    $('.filter-wrapper .tab .tablinks').removeClass('active');
    	    _this.addClass('active');
    	    $('.filter-wrapper .tabcontent').removeClass('open');
    	    $('.filter-wrapper .tabcontent[data-tab="'+ tab_num +'"]').addClass('open');
	    }, 500);
	});
	
	$( document ).tooltip({
		show: null,
		items: ".d-tooptip",
		open: function( event, ui ) {
        ui.tooltip.animate({ top: ui.tooltip.position().top - 10 }, "fast" );
      }
	});
	
	$(document).ready(function() {
		$('.fl-node-61275ae03ab6d, .fl-node-61275ae03ab71').wrapAll('<div class="mouseleave-effect" />');

		var badgeStr = '<span class="badge">30% off</span>';
		$('.main-navigation ul.nav-menu > li:first-child > a').append(badgeStr);
		
		$('body').removeClass('right-sidebar');
		$("body .hoverable").each(function(idx) {
			$(this).find("svg:first-child").mouseover(function(e) {
            	var _idx = idx + 1;
				var igl_bg = $(`.ilg-bgs img[data-idx="${_idx}"]`);
				if(!igl_bg.hasClass("active")) {
                    $('.ilg-bgs img.active').hide();
                    $('.ilg-bgs img').removeClass('active');
                    igl_bg.addClass('active');
                    igl_bg.fadeIn(500);
                }
			});
			
			$(this).find("svg:first-child").on('mouseleave', function() {
				$('.ilg-bgs img.active').hide();
                $('.ilg-bgs img').removeClass('active');
                $('.ilg-bgs img:first-child').addClass('active');
                $('.ilg-bgs img:first-child').fadeIn(500);
			});
		});
		
//Single Product Sticky Image
        
    //     if ($(window).width() > 767) {
    //       $(window).scroll(function(){
    //       	if($('.single-product div.product .images')) {
    //             var aHeight = $('.single-product div.product .summary')[0].scrollHeight;
    //             var slimit = aHeight - $('.single-product div.product .images')[0].scrollHeight - ($(window).scrollTop() - 130);
    //             if($(this).scrollTop() > 130 && slimit > 0){
    //             	$('.single-product div.product .images').css({
    //                 	'marginTop': $(window).scrollTop() - 130,
    //                     'transition': 'margin 0.05s ease-out 0.01s'
    //                 });
				// } else {
    //             	$('.single-product div.product').removeClass('on-scroll');
    //             }
    //         }
            
    //         if($('.single-product div.product .entry-summary-right')) {
    //             var aHeight = $('.single-product div.product .summary')[0].scrollHeight;
    //             var slimit = aHeight - $('.single-product div.product .entry-summary-right')[0].scrollHeight - ($(window).scrollTop() - 130);
    //             if($(this).scrollTop() > 130 && slimit > 0){
    //             	$('.single-product div.product .entry-summary-right').css({
    //                 	'marginTop': $(window).scrollTop() - 110,
    //                     'transition': 'margin 0.05s ease-out 0.01s'
    //                 });
				// } else {
    //             	$('.single-product div.product').removeClass('on-scroll');
    //             }
    //         }
    //       });
    //     }
        
		// Include images
		let img_src = [
		  	'https://biohackingcore.com/wp-content/uploads/2021/09/Untitled-design-16y.png',
			'https://biohackingcore.com/wp-content/uploads/2021/09/Untitled-design-19.png',
			'https://biohackingcore.com/wp-content/uploads/2021/09/Untitled-design-23y.png'
		];

		// Name images included
		let image_type = img_src.map(function(cuurentEl, index){ return "image" + index});

		// Configure particles-js
		particlesJS('particles-js',
		  {
			"particles": {
			  "number": {
				"value": 30, // No of images
				"density": {
				  "enable": true,
				  "value_area": 500 // Specify area (Lesser is greater density)
				}
			  },
			  "color": {
				"value": "#5affd4"
			  },
			  "shape": {
				"type":  image_type, // Add images to particle-js
				"stroke": {
				  "width": 0,
				},
				"polygon": {
				  "nb_sides": 4
				}
			  },
			  "opacity": {
				"value": 0.4, // Adjust opactiy
				"random": false,
				"anim": {
				  "enable": false,
				  "speed": 1,
				  "opacity_min": 0.1,
				  "sync": false
				}
			  },
			  "size": {
				"value": 10, // Adjust the image size
				"random": false,
				"anim": {
				  "enable": false,
				  "speed": 10,
				  "size_min": 40,
				  "sync": false
				}
			  },
			  "line_linked": {
				"enable": false,
				"distance": 200,
				"color": "#ffffff",
				"opacity": 1,
				"width": 2
			  },
			  "move": {
				"enable": true,
				"speed": 1,   // Speed of particle motion
				"direction": "none",
				"random": false,
				"straight": false,
				"out_mode": "out",
				"bounce": false,
				"attract": {
				  "enable": false,
				  "rotateX": 600,
				  "rotateY": 1200
				}
			  }
			},
			"interactivity": {
			  "detect_on": "canvas",
			  "events": {
				"onhover": {
				  "enable": false,
				  "mode": "grab"
				},
				"onclick": {
				  "enable": false,
				  "mode": "push"
				},
				"resize": true
			  },
			  "modes": {
				"grab": {
				  "distance": 400,
				  "line_linked": {
					"opacity": 1
				  }
				},
				"bubble": {
				  "distance": 400,
				  "size": 40,
				  "duration": 2,
				  "opacity": 8,
				  "speed": 3
				},
				"repulse": {
				  "distance": 200,
				  "duration": 0.4
				},
				"push": {
				  "particles_nb": 4
				},
				"remove": {
				  "particles_nb": 2
				}
			  }
			},
			"retina_detect": true
		  }
		);
	});
	
})(jQuery);