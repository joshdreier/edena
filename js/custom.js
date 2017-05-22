/**
 * init gloabl vars
 */
 var isMobile,
 isDesktop;

/***************** Custom functions *******************/

function ie9sameheightbox(){

	if( jQuery(window).width() > 992 ) {

		jQuery('.vc_row-o-equal-height').each(function(index, el) {
			var maxHeight = -1,
			$row = jQuery(this);	

			$row.find('.wpb_column').each(function(index, el) {

				var $col = jQuery('.vc_column-inner', this);

				console.log( 'col height'+ $col.outerHeight( true ) );

				if ( $col.outerHeight( true ) > maxHeight ) {
					maxHeight = $col.outerHeight( true );
				}

			});

			console.log( 'maxheight'+ maxHeight );
			$row.find(' > .wpb_column > .vc_column-inner').css('height', maxHeight );

		});
	}
	
}


/**
 * make it fullscreen
 * @param  {object} $obj wrapper to make fullscreen
 * @return {[type]}      [description]
 */
 function fullscreenWrapper($obj) {
 	var $windowHeight = jQuery(window).height();

 	if(jQuery('.content-wrapper', $obj).height() < $windowHeight){

 		var adminBarOffset = ( jQuery('.admin-bar').length )?jQuery('#wpadminbar').outerHeight(true):0;
 		var $menuHeight = ( !jQuery('.header-transparent').length && !jQuery('.header-boxed').length && !jQuery('.side-menu').length ) ? jQuery('#mainHeader').outerHeight(true) + adminBarOffset : 0 + adminBarOffset ;
 		var $self_paddingtop = $obj.css('padding-top');
 		var $self_paddingbottom = $obj.css('padding-bottom');

 		$obj.height( $windowHeight - ( $menuHeight + parseInt($self_paddingtop) + parseInt($self_paddingbottom) ) );

 	}else{
 		$obj.css('height', jQuery('.content-wrapper', $obj).height());
 	}

 	if(!jQuery('.side-menu').length){
 		$obj.width(jQuery('html').width());		
 	}else{
 		$obj.css('width', 'auto');		
 	}
 	
 }

 /* MAIN MENU (submenu slide and setting up of a select box on small screen)*/
 function initializeMainMenu() {

 	"use strict";
 	var $mainMenu = jQuery('#main-menu').children('ul');

 	if(Modernizr.mq('only all and (max-width: 1024px)') ) {

 	

 		/* Responsive Menu Events */
 		var addActiveClass = false;
 	
 		jQuery('.subMenu').css('display', 'none');
 		jQuery("li:not(.menu-item-object-neko_homesection) a.hasSubMenu, .menu-item-language-current.menu-item-has-children").unbind('click');
 		jQuery('li',$mainMenu).unbind('mouseenter mouseleave');


 		jQuery("a.hasSubMenu").on("click", function(e) {

 			var $this = jQuery(this);	
 			e.preventDefault();


 			addActiveClass = $this.parent("li").hasClass("Nactive");


 			$this.parent("li").removeClass("Nactive");
 			$this.next('.subMenu').slideUp('fast');



 			if(!addActiveClass) {
 				$this.parents("li").addClass("Nactive");
 				$this.next('.subMenu').slideDown('fast');

 			}else{
 				$this.parent().parent('li').addClass("Nactive");
 			}

 			return;
 		});

		/** condition for wpml dropdown menu **/
		jQuery(".menu-item-language-current.menu-item-has-children").on("click touchend", function(e) {

			var $this = jQuery(this);	
			e.preventDefault();

			addActiveClass = $this.hasClass("Nactive");


			$this.removeClass("Nactive");
			$this.children('.sub-menu').slideUp('fast');
			

			if(!addActiveClass) {
				$this.addClass("Nactive");
				$this.children('.sub-menu').slideDown('fast');
			}

			return;
		});


 	}else{


 		jQuery("li", $mainMenu).removeClass("Nactive");
 		jQuery('li:not(.menu-item-object-neko_homesection) a', $mainMenu).unbind('click');
 		jQuery('.subMenu, .sub-menu').css('display', 'none');

 		jQuery('li',$mainMenu).hover(

 			function() {

 				var $this = jQuery(this),
 				$subMenu = $this.children('.subMenu, .sub-menu');


 				if( $subMenu.length ){

 				$this.addClass('hover').stop();	

 				}else {

 					if($this.parent().is(jQuery(':gt(1)', $mainMenu))){

 						$this.stop(false, true).fadeIn('slow');

 					}
 				}


 				if($this.parent().is(jQuery(':gt(1)', $mainMenu))){

 					$subMenu.stop(true, true).fadeIn(200,'easeInOutQuad'); 
 					
 					if($this.parents("li.primary").hasClass('nk-submenu-right')){
 						$subMenu.css('left', -$subMenu.parent().outerWidth(true));
 					}else{
 						$subMenu.css('left', $subMenu.parent().outerWidth(true));
 					}


 				}else{

 					$subMenu.stop(true, true).delay( 300 ).fadeIn(200,'easeInOutQuad');  					

 				}

 			}, function() {

 				var $this = jQuery(this),
 				$subMenu = $this.children('ul');

 				if($this.parent().is(jQuery(':gt(1)', $mainMenu))){


 					$this.children('ul').hide();
 					$this.children('ul').css('left', 0);


 				}else{

 					$this.removeClass('hover');
 					$subMenu.stop(true, true).delay( 300 ).fadeOut();
 				}

 				if( $subMenu.length ){$this.removeClass('hover');}

 			});

 	}
 }



 /* the function to decide the number of columns */
 function setColumns(originalDivider) {
 	var columns  = '';
 	if(jQuery(window).width() <= 767) {
 		columns = 2;
 	} else {
 		columns = originalDivider;
 	}
 	return columns;
 }



/* TO TOP BUTTON */
function toTop(mobile){

	jQuery('#neko-to-top').remove();

	if(isDesktop === true){

		if(!jQuery('#neko-to-top').length){
			jQuery('body').append('<a href="#" id="neko-to-top"><i class="neko-icon-up-open"></i></a>');
		}

	}else{

		if(!jQuery('#neko-to-top').length){
			jQuery('.neko-footer #copyright').append('<a href="#" id="neko-to-top" class="toptop-static"><i class="neko-icon-up-open"></i></a>');
		}

	}

	if (jQuery(this).scrollTop() > 100) {

		jQuery('#neko-to-top').css('right', 15);
		jQuery('#neko-to-top').css('opacity', 1);
	} else {
		jQuery('#neko-to-top').css({'opacity': 0, 'right' : -150});

	}


	jQuery(window).scroll(function () {
		if (jQuery(this).scrollTop() > 100) {
			//jQuery('#neko-to-top').fadeIn('fast');
			jQuery('#neko-to-top').css('right', 15);
			jQuery('#neko-to-top').css('opacity', 1);
		} else {
			jQuery('#neko-to-top').css({'opacity': 0, 'right' : -150});

		}
	});

	jQuery('#neko-to-top').click(function (e) {
		e.preventDefault();
		jQuery("html, body").animate({
			scrollTop: 0
		}, 800, 'easeInOutCirc');

	});
/*	}else{

		if(jQuery('#neko-to-top').length)
			jQuery('#neko-to-top').remove();

	}*/

}


function fixed_header_management(){
	var $window = jQuery(window);

/*	console.log('dh '+jQuery(document).height());
	console.log('wh '+jQuery(window).height() );*/

    if( jQuery('.header-opaque').length && ( jQuery(document).height() > ( jQuery(window).height() + 200 ) ) && !jQuery('.navbar-static-top').length && Modernizr.mq('only all and (min-width: 1025px)')  ){

    	if ( jQuery(window).scrollTop() >= 1 ) {
    		jQuery('#mainHeader').addClass('nk-fixed-header');
    		jQuery('body').addClass('nk-header-scrolled');
    	} else {
    		jQuery('#mainHeader').removeClass('nk-fixed-header');
    		jQuery('body').removeClass('nk-header-scrolled');
    	}

    	/* On Scroll */
    	$window.on('scroll.nekofixedheader', function(e) {
    		if ( jQuery(this).scrollTop() >= 1 ) {
    			jQuery('body:not(.side-menu) #mainHeader').addClass('nk-fixed-header');
    			jQuery('body').addClass('nk-header-scrolled');
    		} else {
    			jQuery('body:not(.side-menu) #mainHeader').removeClass('nk-fixed-header');
    			jQuery('body').removeClass('nk-header-scrolled');
    		}
    	});
    }else{

    	$window.off('scroll.nekofixedheader');
    }
}



function preheader_management(){

	if(jQuery('.nk-autohide-scroll').length && ( ( jQuery(document).height() + 200 ) > jQuery(window).height() )  && Modernizr.mq('only all and (min-width: 769px)') ){


		if ( jQuery(window).scrollTop() >= 50 ) {

			jQuery('.nk-autohide-scroll').css('height', 0).css('display', 'none').end();


		} else {

			jQuery('.nk-autohide-scroll').css('display', 'block').css('height', 'auto').end();

		}

		/* On Scroll */
		jQuery(window).scroll(function () {

			if ( jQuery(this).scrollTop() >= 50 ) {

				jQuery('.nk-autohide-scroll').css('height', 0).slideUp('fast').end();


			} else {

				jQuery('.nk-autohide-scroll').css('height', 'auto').slideDown('fast').end();


			}
		});	
	}
}


function boxed_transparent_fixed_management(){

	    if( jQuery('.boxed-layout').length && jQuery('.header-transparent').length  && !jQuery('.navbar-static-top').length ){

    		if( Modernizr.mq('only all and (min-width: 1025px)') ){
	    		jQuery('.boxed-layout #global-wrapper').css('margin-top', 40);

	    		if ( jQuery(window).scrollTop() >= 40 ) {
	    			jQuery('.boxed-layout #mainHeader').css('top', 0);
	    		}else{
	    			jQuery('.boxed-layout #mainHeader').css('top', 40);
	    		}
	    		

	    		jQuery(window).scroll(function(event) {
	    			if( jQuery(window).scrollTop() >= 40 ){
	    				jQuery('.boxed-layout #mainHeader').css('top', 0);
	    			}else{
	    				jQuery('.boxed-layout #mainHeader').css('top', 40);
	    			}
	    		});
    		}else{
    			jQuery('.boxed-layout #mainHeader').css('top', 0);
    			jQuery('.boxed-layout #global-wrapper').css('margin-top', 0);
    		}
    	}
}


function parallax_management(){

	var $window = jQuery(window); /* You forgot this line in the above example */

    if(jQuery('*[data-type="background"]').length && Modernizr.mq('only all and (min-width: 1025px)') ){

    	

    	jQuery('.neko-parallax-slice').css({
    		'background-attachment': 'fixed',
    		'background-position': '50% 0'
    	});



    	jQuery('*[data-type="background"]').each(function(){

    		var $bgobj = jQuery(this);  /* assigning the object */
    		var $objPos = $bgobj.offset().top;

    		//$bgobj.style.backgroundPosition = "0px " + (0 - (Math.max(document.documentElement.scrollTop, document.body.scrollTop) / 4)) + "px";


    		$window.on('scroll.nekoparallax',function() {

    			var startPos = ( $objPos > 1500 && $bgobj.data('speed') > 0 ) ?  $window.scrollTop() - $bgobj.offset().top :  $window.scrollTop() ; 
    			
    			var yPos = -(  startPos / $bgobj.data('speed') );

    			/* Put together our final background position */
    			var coords = '50% '+ yPos + 'px';

    			/* Move the background */
    			$bgobj.css({ backgroundPosition: coords });
    		});
    	});

    }else{
    	
    	$window.off('scroll.nekoparallax');

    	jQuery('.neko-parallax-slice').css({
    		'background-attachment': 'scroll',
    		'background-size': 'cover',
    		'background-position': 'center center'
    	});
    }

}


function fixed_footer_management(){
    if(  jQuery(".fixed-footer").length && isDesktop === true  ){
    	var OffsetBottom = jQuery('#main-footer-wrapper').outerHeight(true);
    	jQuery('.fixed-footer main').css('margin-bottom', OffsetBottom - 1 );
    }else{
    	jQuery('.fixed-footer main').css('margin-bottom', 0);

    }
}



function neko_header_cart_management(){
	  if(  jQuery("#neko-cart-link").length && isDesktop === true  ){

	    jQuery('#neko-cart-link').hover(function() {
	    	jQuery('#neko-cart-drop-content').stop(true, false).fadeIn('fast');
	    }, function() {
	    	jQuery('#neko-cart-drop-content').stop(true, false).delay(500).fadeOut('fast');
	    });

    }else{
    	jQuery('#neko-cart-link').off('hover');
    }
}

/***************** End Custom functions *******************/



/**
 * Resize only function call
 */
 jQuery(window).on("resize",function(e){



	 	Modernizr.addTest('ipad', function () {
	 		return !!navigator.userAgent.match(/iPad/i);
	 	});

	 	if (!Modernizr.ipad) {  
	 		initializeMainMenu(); 
	 	}

	 	preheader_management();
	 	boxed_transparent_fixed_management();
	 	parallax_management();
	 	fixed_footer_management();
	 	fixed_header_management();
	 	neko_header_cart_management();

	 	/* mobile detection */
	 	if(Modernizr.mq('only all and (max-width: 767px)') ) {
	 		isMobile = true;
	 	}else{
	 		isMobile = false;
	 	}


	 	/* desktop detection */
	 	if(Modernizr.mq('only all and (max-width: 1024px)') ) {
	 		isDesktop = false;
	 	}else{
	 		isDesktop = true;
	 	}

 });

/**
 * Load and resize function call
 */
 jQuery(window).on("load resize",function(e){
 	toTop(isMobile);
});

/**
 * Doc ready function
 */
 (function($) {
 	"use strict";

 	/* mobile detection */
 	if(Modernizr.mq('only all and (max-width: 767px)') ) {
 		isMobile = true;
 	}else{
 		isMobile = false;
 	}

 	/* desktop detection */
 	if(Modernizr.mq('only all and (max-width: 1024px)') ) {
 		isDesktop = false;
 	}else{
 		isDesktop = true;
 	}


 	/*
    |--------------------------------------------------------------------------
    | IPAD HOVER BUG FIX
    |--------------------------------------------------------------------------
    */ 
     
    if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))) {
    	$("figure.img-hover a").unbind('click');
    	$("figure.img-hover").bind('touchstart', function(){});
    }

 	/*
    |--------------------------------------------------------------------------
    | END IPAD HOVER BUG FIX
    |--------------------------------------------------------------------------
    */   




    /*
    |--------------------------------------------------------------------------
    | RESPONSIVE TEXT
    |--------------------------------------------------------------------------
    */
    if(jQuery('.resHeading1').length){
    	jQuery(".resHeading1").fitText(1.2, { minFontSize: '24px', maxFontSize: '125px' });
    }
    if(jQuery('.resHeading2').length){
    	jQuery(".resHeading2").fitText(1.2, { minFontSize: '18px', maxFontSize: '75px' });
    }
    if(jQuery('.resHeading3').length){
    	jQuery(".resHeading3").fitText(1.1, { minFontSize: '18px', maxFontSize: '50px' });
    }

    /*
    |--------------------------------------------------------------------------
    | INIT MENU
    |--------------------------------------------------------------------------
    */
    preheader_management();
    initializeMainMenu();
    boxed_transparent_fixed_management();
    parallax_management();
    neko_header_cart_management();

    /* Debug css rules */
    //countCSSRules();
   

    /*
    |--------------------------------------------------------------------------
    | Transparent header color animation
    |--------------------------------------------------------------------------
    */
    if( jQuery('.header-transparent').length ){
    	/* On load */

    	// if( jQuery('.no-page-header').length && !jQuery('.wpb_row').length && !jQuery('.blog').length ){
    	// 	jQuery('#mainHeader').addClass('scrolled');
    	// }else{

    		if ( jQuery(window).scrollTop() >= 50 ) {
    			jQuery('#mainHeader').addClass('scrolled');

    		} else {
    			jQuery('#mainHeader').removeClass('scrolled');
    		}

    		/* On Scroll */
    		jQuery(window).scroll(function () {
    			if ( jQuery(this).scrollTop() >= 50 ) {
    				jQuery('#mainHeader').addClass('scrolled');
    			} else {
    				jQuery('#mainHeader').removeClass('scrolled');
    			}
    		});

    	// }




    }


    /*
    |--------------------------------------------------------------------------
    | VC detection
    |--------------------------------------------------------------------------
    */
    // if( !jQuery('.wpb_row').length ){
    // 	jQuery('body.header-transparent.no-page-header main').css('padding-top', 44);
    // }else{
    // 	jQuery('body.header-transparent.no-page-header').css('padding-top', 0);
    // }




    /*
    |--------------------------------------------------------------------------
    | TOOLTIP
    |--------------------------------------------------------------------------
    */
    jQuery('.tips').tooltip();
    

 	/*
    |--------------------------------------------------------------------------
    | Fit Vidz
    |--------------------------------------------------------------------------
    */   
    jQuery('.entry-content iframe, .entry-content embed, iframe').parent().fitVids({customSelector: "iframe[src^='https://w.soundcloud.com/'], iframe[src^='http://www.dailymotion.com/'], embed[src='http://v.wordpress.com/']"});
    

    /*
    |--------------------------------------------------------------------------
    | BACKGROUND VIDEO
    |--------------------------------------------------------------------------
    */

    /* youtube */
    if(jQuery('.youtube-video-bg').length){
    	jQuery('.youtube-video-bg').each(function() {
    		var $this = jQuery(this);
    		$this.mb_YTPlayer();  
    		$this.on("YTPData",function(e){
    			jQuery(this).setProperty( 'background-image', 'none', 'important' );
    		});
    	});  
    }
    
    /* HTML-5 */
    if ($('#html5Video').length){ }

    /*
    |--------------------------------------------------------------------------
    | Rollover boxIcon
    |--------------------------------------------------------------------------
    */ 
    if($('.boxIcon').length){

    	$('.boxIcon').hover(function() {

    		var $this = $(this);

    		$this.css('opacity', '1');   
    		$this.addClass('hover');
    		$this.find('.boxContent>p').stop(true, false).css('display', 'block');
    		$this.find('i').addClass('triggeredHover');    

    	}, function() {
    		var $this = $(this);
    		$this.removeClass('hover');
    		$this.find('i').removeClass('triggeredHover'); 
    	});   
    }   


    /*
    |--------------------------------------------------------------------------
    | PRETTY PHOTOS
    |--------------------------------------------------------------------------
    */      
    if( jQuery("a.prettyPhoto").length){
    	jQuery("a.prettyPhoto").prettyPhoto({
    		animation_speed:'fast',
    		slideshow:10000, 
    		hideflash: true,
    		social_tools:false,
    		allow_resize: true
    	});
    }

    /*
    |--------------------------------------------------------------------------
    | MAGNIFIC POPUP
    |--------------------------------------------------------------------------
    */      
    if( jQuery("a.neko-magnificPopImg").length){
    	
    	jQuery("a.neko-magnificPopImg").magnificPopup({
    		type: 'image',
    		fixedContentPos: false,
    		fixedBgPos: true,
    		preloader: true,
    		midClick: true,
    		focus: 'a.neko-magnificPopImg',
    		closeOnContentClick:true
    	});
    }

    if( jQuery("a.neko-magnificPopVideo").length){

    	jQuery("a.neko-magnificPopVideo").magnificPopup({
    		fixedContentPos: false,
    		type: 'iframe',
    		preloader: false,
    		fixedBgPos: true,
    		mainClass: 'mfp-fade',
    		midClick: true,
    		disableOn: 200,
    		closeOnContentClick:true,
    		focus: 'a.neko-magnificPopVideo',
    		patterns: {
    			youtube: {
    				index: 'youtube.com/', 
    				id: 'v=', 
    				src: '//www.youtube.com/embed/%id%?autoplay=1' 
    			},
    			vimeo: {
    				index: 'vimeo.com/',
    				id: '/',
    				src: '//player.vimeo.com/video/%id%?autoplay=1'
    			}
    		}

    	});
    }
    

    if( $("a.neko-magnificPopGallery").length){

    	$("a.neko-magnificPopGallery").click(function (e) {

    		var items = [];

    		items.push( { src: $(this).attr('href')  } );
    		
    		if($(this).data('gallery')){

    			var $arraySrc = $(this).data('gallery').split(',');

    			$.each( $arraySrc, function( i, v ){
    				items.push( {
    					src: v 
    				});
    			});     
    		}

    		$.magnificPopup.open({
    			type:'image',
    			fixedContentPos: false,
    			mainClass: 'mfp-fade',
    			items:items,
    			fixedBgPos: true,
    			focus: 'a.neko-magnificPopGallery',
    			gallery: {
    				enabled: true 
    			}
    		});

    		e.preventDefault();
    	});

    }



    /*
    |--------------------------------------------------------------------------
    | OWL
    |--------------------------------------------------------------------------
    */  

    if(jQuery('.owlCarouselSlideshow').length){
    	jQuery(".owlCarouselSlideshow").owlCarousel({
    		items:1,
    		pagination:true,
    		paginationNumbers:true,
    		autoHeight : true,

    	});
    }

    if(jQuery('.nekoOwlCarouselSlideshowThumb').length){


    	var owlThumb = jQuery('.nekoOwlCarouselSlideshowThumb');

    	owlThumb.owlCarousel({
    		navigation: false,
    		items:1,
    		singleItem:true,
    		pagination:true,
    		transitionStyle : "fade",
    		responsive: true,
    		autoHeight : true,


    		afterInit : function() {

		    	if( jQuery(this.owl.userItems).width() >= 750 ){


		    		jQuery('.nekoOwlCarouselSlideshowThumb.owl-theme .owl-controls').css('margin-top', 0);
		    		jQuery('.nekoOwlCarouselSlideshowThumb.owl-theme .owl-controls .owl-pagination').css({
		    			'text-align': 'left',
		    			'line-height' : 0
		    		});

		    		jQuery('.nekoOwlCarouselSlideshowThumb .owl-controls .owl-page').css('width', '20%');

		    		var Links = jQuery('.owl-controls .owl-page span', this.owl.baseElement);

		    		jQuery.each( this.owl.userItems, function (i) {

		    			jQuery(Links[i]).addClass('nekoGalThumbNav').css({
		    				'background': 'url(' + $(this).find('img').attr('src') + ') center center no-repeat',
		    				'-webkit-background-size': 'cover',
		    				'-moz-background-size': 'cover',
		    				'-o-background-size': 'cover',
		    				'background-size': 'cover'
		    			});

		    		});	

		    	}else{

		    		jQuery('.nekoOwlCarouselSlideshowThumb.owl-theme .owl-controls').css('margin-top', 10);
		    		jQuery('.nekoOwlCarouselSlideshowThumb.owl-theme .owl-controls .owl-pagination').css('text-align', 'center');

		    	}

    		},


    		afterUpdate:function() {

		    	if( jQuery(this.owl.userItems).width() >= 750 ){


		    		jQuery('.nekoOwlCarouselSlideshowThumb.owl-theme .owl-controls').css('margin-top', 0);
		    		jQuery('.nekoOwlCarouselSlideshowThumb.owl-theme .owl-controls .owl-pagination').css({
		    			'text-align': 'left',
		    			'line-height' : 0
		    		});

		    		jQuery('.nekoOwlCarouselSlideshowThumb .owl-controls .owl-page').css('width', '20%');

		    		var Links = jQuery('.owl-controls .owl-page span', this.owl.baseElement);

		    		jQuery.each( this.owl.userItems, function (i) {

		    			jQuery(Links[i]).addClass('nekoGalThumbNav').css({
		    				'background': 'url(' + $(this).find('img').attr('src') + ') center center no-repeat',
		    				'-webkit-background-size': 'cover',
		    				'-moz-background-size': 'cover',
		    				'-o-background-size': 'cover',
		    				'background-size': 'cover'
		    			});

		    		});	

		    	}else{

		    		jQuery('.nekoOwlCarouselSlideshowThumb.owl-theme .owl-controls').css('margin-top', 10);
		    		jQuery('.nekoOwlCarouselSlideshowThumb.owl-theme .owl-controls .owl-pagination').css('text-align', 'center');

		    	}

    		}


    	});




    }

 



    if($('.neko-data-owl').length){

    	$( '.neko-data-owl' ).each(function( index ) {
    		var $this =$(this);
    		$this.owlCarousel(
    		{
    			items:$this.data('neko_items'),
    			navigation:$this.data('neko_navigation'),
    			singleItem:$this.data('neko_singleitem'),
    			autoPlay:($this.find('.item').length == 1) ? false : $this.data('neko_autoplay'),
    			itemsScaleUp:true,
    			navigationText:['<i class="neko-icon-angle-left"></i>','<i class="neko-icon-angle-right"></i>'], 
    			pagination:$this.data('neko_pagination'),
    			paginationNumbers:$this.data('neko_paginationnumbers'),
    			autoHeight:$this.data('neko_autoheight'),
    			mouseDrag:$this.data('neko_mousedrag'),
    			transitionStyle:$this.data('neko_transitionstyle'),
    			responsive:true,
    			lazyLoad : true,
    			addClassActive:true,
    			itemsDesktop : [1199,3],
    			itemsDesktopSmall: [979,2],
    			itemsTablet: [768,1],
    			itemsMobile: [479,1],  			
    			afterInit: function(){

    				$('.active .caption-content-position', $this).children().each(function(index, val) {
    					$(this).addClass('animated '+$(this).data('neko_animation'));
    				});
    			},
    			beforeMove:  function(){
    				$('.caption-content-position').children().each(function(index, val) {
    					$(this).removeClass('animated '+$(this).data('neko_animation'));
    				});
    			},
    			afterMove:  function(){
    				$('.active .caption-content-position', $this).children().each(function(index, val) {
    					$(this).addClass('animated '+$(this).data('neko_animation'));
    				});

    			}
    		});

});

}




    /*
    |--------------------------------------------------------------------------
    | ONE PAGEARROW NAV
    |--------------------------------------------------------------------------
    */  


    if(jQuery('.arrowsNav').length){

    	jQuery('.arrowsNav').each(function(i){
    		var $this = jQuery(this),
    		$top = parseInt($this.parent().css('padding-top'));
    		$this.css('top', -$top );
    		
    	});	
    	
    	
    	var mHHeight = (jQuery('.fixedMenu').length)?jQuery('#mainHeader').parent().outerHeight(true) - 1:0;


    	jQuery('.arrowsNav .navUp').click(function (e) {

    		e.preventDefault();

    		var $this = jQuery(this),
    		section = $this.parents('section.mainSection');
    		

    		if( section.prev('section.mainSection').length ){
    			jQuery('html,body').animate({ scrollTop: section.prev('section.mainSection').offset().top - mHHeight}, 'slow', 'easeInOutQuad');
    		}  		

    	});

    	jQuery('.arrowsNav .navDown').click(function (e) {
    		
    		e.preventDefault();

    		var $this = jQuery(this),
    		section = $this.parents('section.mainSection');
    		

    		if( section.next('section.mainSection').length ){
    			jQuery('html,body').animate({ scrollTop: section.next('section.mainSection').offset().top - mHHeight}, 'slow', 'easeInOutQuad');
    		}

    	});
    }

    /*
    |--------------------------------------------------------------------------
    | ONE PAGE NAV
    |--------------------------------------------------------------------------
    */  


    jQuery('#mainHeader a, a.btn, .featureBox a').each( function(index, val) {
    	var $this = jQuery(this);

    	if($this.attr('href') !== undefined){

    		$this.bind('click',function(e){
    			var $anchor  = $this,
    			content      = $anchor.attr('href'),
    			checkURL     = content.match(/^#([^\/]+)$/i),
    			mHHeight     = (jQuery('.navbar-fixed-top').length)?jQuery('.navbar-header').outerHeight(true):0;

    			if(checkURL){
    				e.preventDefault();
    				jQuery('html,body').animate({ scrollTop : jQuery($anchor.attr('href')).offset().top - mHHeight + "px"}, 1200, 'easeInOutExpo');
    				if(jQuery('.navbar-fixed-top').length){
    					if(jQuery(".navbar-toggle").css('display') == 'block'){
    						jQuery(".navbar-toggle").trigger('click');
    					}
    				}
    			}
    		});
    	}
    });



    /*
    |--------------------------------------------------------------------------
    | EDIT LINKS
    |--------------------------------------------------------------------------
    */

    if(jQuery('a.post-edit-link').length || jQuery('a.comment-edit-link').length){
    	jQuery('a.post-edit-link, a.comment-edit-link').attr('target', '_blank');	
    }



    if(!$.trim( $('.site-content').html() ).length  ){
    	$('#page-content').css('display', 'none');
    }


	 /**
	  * IE 9 progress bar
	  * @param 
	  */
    if( jQuery('.lt-ie10').length &&  jQuery('.vc_bar').length){
    	jQuery('.vc_bar').each(function(index, el) {
    		var pourcent = jQuery(this).data('percentage-value');
    		jQuery(this).css({
    			'width': pourcent +'%',
    			'height': '100%',
    			'display': 'block' 
    		}); 
    	});
    }







	jQuery(document).on('click','.ajax-remove-item', function(e) { 
		e.preventDefault();		

		var $thisbutton = $(this);
		
		var data = {
				action: 		'woocommerce_remove_from_cart',
				remove_item: 	$thisbutton.attr('rel')
		};
		
		var $window_width = $(window).width();
		var $document_scroll = $(document).scrollTop();
		

		
		jQuery.post( woocommerce_params.ajax_url, data, function( response ) {

			var fragments = response.fragments;
			var cart_hash = response.cart_hash;
			
			if ( fragments ) {
				jQuery.each(fragments, function(key, value) {
					jQuery(key).replaceWith(value);
				});

				jQuery('#neko-cart-drop-content').css('display', 'block');

			}
			
		});
		
	});












}) (jQuery); /* END DOC READY */



/*
|--------------------------------------------------------------------------
| EVENTS TRIGGER AFTER ALL IMAGES ARE LOADED
|--------------------------------------------------------------------------
*/
jQuery(window).load(function() {
	"use strict";

	 /**
	  * IE 9 same height cols
	  * @param 
	  */
    if( jQuery('.lt-ie10').length &&  jQuery('.vc_row-o-equal-height').length ){
    	ie9sameheightbox();
    }



	fixed_footer_management();

   /*
    |--------------------------------------------------------------------------
    |  fullwidth image a video
    |--------------------------------------------------------------------------
    */
    if (jQuery('.nk-fullscreen').length){ fullscreenWrapper(jQuery('.nk-fullscreen')); }

    jQuery(window).on("resize",function(e){
    	if (jQuery('.nk-fullscreen').length)
    	{
    		fullscreenWrapper(jQuery('.nk-fullscreen'));
    	}
    });

    if(jQuery('.header-transparent .neko_featured_post').length){

    	jQuery('.header-transparent .neko_featured_post').css('padding-top', jQuery('#mainHeader').outerHeight(true));

    	jQuery(window).on("resize",function(e){
    		jQuery('.header-transparent .neko_featured_post').css('padding-top', jQuery('#mainHeader').outerHeight(true));	
    	});

    }

	 fixed_header_management();

   /*
    |--------------------------------------------------------------------------
    | WP Masonry for blog
    |--------------------------------------------------------------------------
    */  
    if (jQuery('.blog-grid').length){

	    //set the container that Masonry will be inside of in a var
	    var container = document.querySelector('.blog-grid');
	    //create empty var msnry
	    var msnry;
	    // initialize Masonry after all images have loaded
	    imagesLoaded( container, function() {
	    	msnry = new Masonry( container, {
	    		itemSelector: '.gridBlogItem',
	    		onLayout: function( $elems, instance ) {
	    			
	    		}
	    	});
	    	
	    	jQuery('.blog-grid').animate({ opacity: 1 }, 300, function() {msnry.layout();});

	    });

	    jQuery( window ).on( "orientationchange", function( event ) {
	    	msnry.layout();
	    });
	}



   /*
    |--------------------------------------------------------------------------
    | ONE PAGE NAV BACK FROM MULTI PAGE
    |--------------------------------------------------------------------------
    */  

    var url = document.location.toString(), 
    idx = url.indexOf("#");
    var hash = idx != -1 ? url.substring(idx+1) : "";

    if(typeof hash !== 'undefined' && hash !== ''){
    	setTimeout(function(){ jQuery('a[href=#'+hash+']').trigger('click'); }, 800);
    } 



	/*
    |--------------------------------------------------------------------------
    | PRELOADER
    |--------------------------------------------------------------------------
    */
    if(jQuery('#status').length){
        // jQuery('#status').fadeOut(); // will first fade out the loading animation
        jQuery('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
        // jQuery('html').delay(350).css({'overflow':'visible'});
    }     


	/*
    |--------------------------------------------------------------------------
    |  Header Animation titles & subtitle
    |--------------------------------------------------------------------------
    */
    if(jQuery('.page-header h1.big-heading').length){

    	if(!jQuery('.lt-ie10').length){
    		jQuery('.page-header h1.big-heading').addClass('neko-fast-animated').delay(1000).queue(function(){
    			jQuery(this).addClass("fadeInDown").dequeue();
    		});
    	}else{
    		jQuery('.page-header h1.big-heading').css('opacity', 1);
    	}


    }

    if(jQuery('.page-header h2.subtitle').length){
    	if(!jQuery('.lt-ie10').length){
	    	jQuery('.page-header h2.subtitle').addClass('neko-fast-animated').delay(1000).queue(function(){
	    		jQuery(this).addClass("fadeInUp").dequeue();
	    	});
    	}else{
    		jQuery('.page-header h1.big-heading').css('opacity', 1);
    	}
    }

	/*
    |--------------------------------------------------------------------------
    |  Header Animation titles & subtitle
    |--------------------------------------------------------------------------
    */
    if(jQuery('.gallery').length){
    	jQuery('.gallery-item').hover(function() {
    		jQuery('.gallery dd').stop().slideUp('fast').end();
    		jQuery('dd', this).stop().slideDown('fast').end();
    	}, function() {
    		jQuery('dd', this).stop().slideUp('fast').end();
    	});
    }
    


}); /* END WINDOW LOAD */


