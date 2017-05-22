<?php


function neko_get_custom_styles($switcherArray = null) {

	global $post;
	$customizerOptions = thsp_cbp_get_options_values(); 

	$neko_custom_styles='';

	$colors = $customizerOptions;

	//echo '</pre>';print_r($customizerOptions);echo '<pre>'; exit();

	/* colors */
	$body_bg_image                   = $customizerOptions['bodylayoutbgimg'];
	$content_background_color        = $colors['background_color'];
	
	$post_background_color           = $colors['post_background_color'];
	
	$body_text_color                 = $colors['body_text_color'];
	$headings_color                  = $colors['headings_color'];
	
	$links_color                     = $colors['links_color'];
	$links_hover_color               = $colors['hover_links_color'];
	
	$accent_color                    = $colors['accent_color'];
	$neutral_color                   = $colors['neutral_color'];
	
	$btn_color                       = $colors['btn_color'];
	$btn_text_color                  = $colors['btn_text_color'];
	$btn_hover_color                 = $colors['btn_hover_color'];
	$btn_hover_text_color            = $colors['btn_hover_text_color'];
	
	$header_background_color         = $colors['header_background_color'];
	$top_level_menu_bg_color         = $colors['top_level_menu_bg_color'];
	$top_level_menu_text_color       = $colors['top_level_menu_text_color'];
	$top_level_menu_bg_color_hover   = $colors['top_level_menu_bg_color_hover'];
	$top_level_menu_text_color_hover = $colors['top_level_menu_text_color_hover'];

	$top_level_menu_transparent_text_color = $colors['top_level_menu_transparent_text_color'];
	$top_level_menu_transparent_text_color_hover = $colors['top_level_menu_transparent_text_color_hover'];
	
	$footer_background_color         = $colors['footer_bg_color'];
	$footer_text_color               = $colors['footer_text_color'];
	$footer_secondary_color          = $colors['footer_secondary_color'];
	
	$footer_link_color               = $colors['footer_link_color'];
	$footer_hover_link_color         = $colors['footer_hover_link_color'];
	
	$copyright_background_color      = $colors['footer_copyright_bg_color'];
	$copyright_text_color            = $colors['footer_copyright_text_color'];
	$copyright_link_color            = $colors['footer_copyright_link_color'];
	$copyright_hover_link_color      = $colors['footer_copyright_hover_link_color'];
	
	$preloader_selector              = ( !empty($customizerOptions['preloader_selector']) && 'none' !== $customizerOptions['preloader_selector'] ) ? $customizerOptions['preloader_selector'] : 'signal'; 
	
	$logo                            = $customizerOptions['logo'];
	$logo_white                      = $customizerOptions['logo_transparent'];
	$logo_retina                     = $customizerOptions['logo_retina'];
	$logo_retina_white               = $customizerOptions['logo_transparent_retina'];
	$logo_width                      = $customizerOptions['logo_width'];
	$logo_height                     = $customizerOptions['logo_height'];
	
	$header_padding									 = $customizerOptions['navbarpadding'];

	$header_height                   = $logo_height + $header_padding*2;
	if ($logo_width > 220){
		$header_height_mobile = floor( 220*$logo_height/$logo_width) +20;
	} else{
		$header_height_mobile = $logo_height +20;
	}

 

	if(neko_is_blog() && !is_single() && !is_attachment()  ){

		$display_header = ('on' === $customizerOptions['display_blog_header'] ) ? true : false ;

		if( $display_header ){
			$page_for_posts = get_option( 'page_for_posts' );
			/* transparency override in page and posts */
			$nav_transparency_override = get_post_meta( $page_for_posts, 'neko_overrideheaderoption', true );
		}else{
			$nav_transparency_override = '1';	
		}


	}else{
		/* transparency override in page and posts */
		$nav_transparency_override = get_post_meta( get_the_ID(), 'neko_overrideheaderoption', true );
	}


	if( is_attachment() ){
		$nav_transparency_override = '1';	
	}

	/* defines priority for transparency settings ( override first => customizer option )*/
	$navbar_transparency_setting = ( !empty($nav_transparency_override) && 'emptylabel' !== $nav_transparency_override) ? $nav_transparency_override : $customizerOptions['navbartransparency'] ;
	$header_transparency         = ( $navbar_transparency_setting  == 'transparent') ? '0' : $navbar_transparency_setting ;


	$blog_header_size         = $customizerOptions['size_blog_header'];
	$blog_header_parallax     = $customizerOptions['parallax_blog_header'];
	$blog_header_image        = $customizerOptions['blog_header_image'];
	$blog_header_mask_color   = $customizerOptions['blog_header_mask_color'];
	$blog_header_mask_opacity = $customizerOptions['blog_header_mask_opacity'];

	/* font */
	$heading_font = ( !empty($customizerOptions['heading_font']) ) ? $customizerOptions['heading_font'] : 'Ubuntu, sans-serif;' ; 	
	$body_font    = ( !empty($customizerOptions['body_font']) ) ? $customizerOptions['body_font'] : 'Ubuntu, sans-serif;' ; 	


	/* font weight */
	$patterns     = array('/regular/', '/@\s(.*)italic\s/sm','/100italic/', '/200italic/', '/300italic/', '/500italic/', '/600italic/', '/700italic/', '/800italic/', '/900italic/');
	$replacements = array('400', '400', '100', '200', '300', '500', '600', '700', '800', '900');

	$h1_fontweight = 700;
	$h1_fontstyle = 'normal';
	if( !empty( $customizerOptions['h1_font_weight']) ){
		$h1_fontweight   = preg_replace($patterns, $replacements, $customizerOptions['h1_font_weight']);
		$h1_fontstyle    = ( strstr( $customizerOptions['h1_font_weight'], 'italic' ) ) ? 'italic' : 'normal';		
	}

	$h2_fontweight = 500;
	$h2_fontstyle = 'normal';	
	if( !empty( $customizerOptions['h2_font_weight']) ){
	$h2_fontweight   = preg_replace($patterns, $replacements, $customizerOptions['h2_font_weight']);
	$h2_fontstyle    = ( strstr( $customizerOptions['h2_font_weight'], 'italic' ) ) ? 'italic' : 'normal';
	}
	
	$body_fontweight = 400;
	$body_fontstyle  = 'normal';
	if( !empty($customizerOptions['body_font_weight']) ){
		$body_fontweight = preg_replace($patterns, $replacements, $customizerOptions['body_font_weight']);
		$body_fontstyle  = ( strstr( $customizerOptions['body_font_weight'], 'italic' ) ) ? 'italic' : 'normal';		
	}

	$body_font_size = '12px';
	if( !empty($customizerOptions['body_font_size']) ){
		$body_font_size = $customizerOptions['body_font_size'].'px';
	}
	

	$body_line_height = '1.5';
	if( !empty($customizerOptions['body_line_height']) ){
		$body_line_height          = $customizerOptions['body_line_height'];
	}
	
	$h1_size = '36px';
	if( !empty($customizerOptions['h1_font_size']) ){
		$h1_size  = $customizerOptions['h1_font_size'].'px';
	}


	$h1_letterspacing          = ( !empty($customizerOptions['h1_letter_spacing']) ) ? 'letter-spacing :'. $customizerOptions['h1_letter_spacing'].'em ;' : '';
	$h1_lettercase             = ( !empty($customizerOptions['h1_letter_case']) ) ? 'text-transform : uppercase;' : ''; 
	
	$h2_size = '24px';
	if( !empty($customizerOptions['h2_font_size']) ){
		$h2_size  = $customizerOptions['h2_font_size'].'px';
	}


	$h2_letterspacing          = ( !empty($customizerOptions['h2_letter_spacing']) ) ? 'letter-spacing :'. $customizerOptions['h2_letter_spacing'].'em ;' : '';
	$h2_lettercase             = ( !empty($customizerOptions['h2_letter_case']) ) ? 'text-transform : uppercase;' : ''; 

	$h3_size  = '20.4px';
	if( !empty($customizerOptions['h2_font_size']) ){
	$h3_size  = floor($customizerOptions['h2_font_size']*0.85).'px';
	}
	$h3_line_height   = 1/$h3_size * $header_padding;

	$h4_size = '14.4px';
	if( !empty($customizerOptions['h2_font_size']) ){
		$h4_size = floor($customizerOptions['h2_font_size']*0.6).'px';
  }
	$h4_line_height   = 1/$h4_size * $header_padding;


	$neko_custom_styles.='hr { border-color:'.$neutral_color .';}';

	/* body */
	$neko_custom_styles.='body {font-family:'.$body_font.', sans-serif; font-style:'.$body_fontstyle.';  font-size:'.$body_font_size.'; font-weight:'.$body_fontweight.';color:'.$body_text_color.'; line-height:'.$body_line_height.';';

	$neko_custom_styles.='background-color:'.$content_background_color.';';

	if( !empty($body_bg_image) ){
		$neko_custom_styles.='background-image:url('.$body_bg_image.');';
		$neko_custom_styles.='background-repeat:no-repeat;';
		$neko_custom_styles.='background-size:cover;';
	}

	$neko_custom_styles.=';}';


	$neko_custom_styles.='.header-pusher{display:none;}';

	$neko_custom_styles.='
	@media(min-width:1025px){

		body.fixedMenu.header-transparent:not(.no-page-header),
		body.fixedMenu.header-transparent.blog{
			padding-top:0;
		}

		.header-pusher{display:block;height:'.$header_height.'px;}


	}';





	/* Main bg color */
	$neko_custom_styles .= 'main#content, main#page-content{ background-color: '.$content_background_color .' }';

	/* headings */
	$neko_custom_styles.= '.big-heading, h1, h2, h3, h4, h5, h6, legend, h1.entry-title a, .stylish-heading h1, .stylish-heading h2:not(.medium-heading) {font-family:'.$heading_font.', sans-serif; color:'.$headings_color.';}';
	$neko_custom_styles.= '.tp-caption.edenaheading1, .edenaheading1, .tp-caption.edenaheading1dark, .edenaheading1dark, .tp-caption.edenaheading2, .tp-caption.edenaheading3, .tp-caption.edenaheading4 {font-family:'.$heading_font.', sans-serif;}';

	$neko_custom_styles.= 'p.lead {color:'.$accent_color.';}';
	$neko_custom_styles.= 'blockquote {border-color:'.$neutral_color.'}';

	$neko_custom_styles.= 'h1, h1.entry-title, .stylish-heading h2.medium-heading {font-weight:'.$h1_fontweight.'; font-style:'.$h1_fontstyle.'; '.$h1_letterspacing.' '.$h1_lettercase.'}';
	$neko_custom_styles.= 'h2, .tp-caption.edenaheading2, .edenaheading2 {font-weight:'.$h2_fontweight.'; font-style:'.$h2_fontstyle.'; '.$h2_letterspacing.' '.$h2_lettercase.'}';
	$neko_custom_styles.= 'h3 {font-size:'.$h3_size.'; line-height:'.$h3_line_height.'; font-weight:400; font-style:'.$h2_fontstyle.';}';
	$neko_custom_styles.= 'h4 {font-size:'.$h4_size.'; line-height:'.$h4_line_height.'; font-weight:400; font-style:'.$h2_fontstyle.';}';


	// BEGIN media query heading sizes

	$neko_custom_styles .= '@media(min-width:1025px){';

	$neko_custom_styles.= 'h1, h1.entry-title {font-size:'.$h1_size.';}';

	$neko_custom_styles.= 'h2, .tp-caption.edenaheading2, .edenaheading2 {font-size:'.$h2_size.';}';

	$neko_custom_styles.= '.page-header h1, .page-header h2.h1 {font-size:'.$h2_size.';}';

	
	//$neko_custom_styles.= '.page-header h1.big-heading span {font-size:'.$subtitle_size.';  }';
	
	$neko_custom_styles.= '}';

	$neko_custom_styles.= 'body .page-header .container::after, body .page-header .container-fluid:after { background-color:'.$neutral_color.';}';

	

	// END edia query heading sizes


	$neko_custom_styles.=' @media(min-width:768px){';

	$neko_custom_styles.='.stylish-heading h2.medium-heading {font-size:'.$h1_size.';}';

	$neko_custom_styles.=' }';

	/* links and buttons */
	$neko_custom_styles.='a, a:link, a:visited { color:'.$links_color.';}';

	$neko_custom_styles.='a:hover { color:'.$links_hover_color.';}';

	$neko_custom_styles.='a[href^="mailto:"]{ color:'.$links_color.';}';

	$neko_custom_styles.='
	a.btn,
	#main-menu ul li a.btn,
	button,
	input[type="submit"],
	a.comment-reply-link,
	.previous-image a,
	.next-image a
	{ color:'.$btn_text_color.'; background:'.$btn_color.'; }';

	$neko_custom_styles.='
	a.btn:hover,
	#main-menu ul li a.btn:hover,
	.header-modern #main-menu ul li a.btn:hover,
	button.btn:hover, 
	.btn-primary:hover, 
	.btn-success:hover, 
	.btn-warning:hover, 
	.btn-info:hover, 
	input[type="submit"]:hover,
	button:hover:not(.mfp-close), 
	.btn:focus,
	a.comment-reply-link:hover, 
	a i.iconRounded:hover,
	a i.icon-rounded:hover,
	.previous-image a:hover,
	.next-image a:hover,
	.primary a.vc_general.vc_btn3:hover
	{ color:'.$btn_hover_text_color.'; background:'.$btn_hover_color.'; border-color:rgba(0, 0, 0, 0.25);}';

	// $neko_custom_styles.='#main-menu .action-link a:hover {color:'.$btn_hover_color.';}';





	$neko_custom_styles.='
	a.more-link	{ color:'.$body_text_color.'; background:'.$content_background_color.'; border-color:'.$body_text_color.';}';

	$neko_custom_styles.='
	a.more-link:hover { color:'.$content_background_color.'; background:'.$body_text_color.'; border-color:'.$body_text_color.';}';


	$neko_custom_styles.='a.btn.btn-primary, button.btn.btn-primary{ color:'.$btn_hover_text_color.'; background:'.$btn_hover_color.'; }';
	$neko_custom_styles.='a.btn.btn-primary:hover, button.btn.btn-primary:hover, .btn.btn-primary:focus { color:#555; background:#eee;}';

	$neko_custom_styles.= 'nav.neko_portfolio_filter .btn:hover,  nav.neko_portfolio_filter .btn.current {color:'.$btn_text_color.'; background:'.$btn_color.'; }';
	$neko_custom_styles.= '.pager li > a:hover {background:'.$btn_color.'; color:'.$btn_text_color.'; }';

	/* icons */
	$neko_custom_styles.='.iconRounded { background-color:'.$accent_color.'; color:'.$content_background_color.';}';
	$neko_custom_styles.='.icon-rounded { background-color:'.$accent_color.'; color:'.$content_background_color.';}';

	/* page header */

	$neko_custom_styles.='.neko-page-header {background-color:'.$content_background_color.'; }';
	$neko_custom_styles.='.header-default.page-header .container::after {background:'.$neutral_color.'; }';


	/* tables */
	
	$neko_custom_styles.= '.post table thead th,  .page table thead th {background-color: '.$neutral_color.';}';
	
	$neko_custom_styles.= '.post table th, .post table td,  .page table th, .page table td {border-color: '.$neutral_color.';}';


	/* owl slider */
	$neko_custom_styles.='.owl-theme .owl-controls .owl-page span, .owl-theme .owl-controls .owl-buttons div{ background:'.$btn_color.'; }';
	
	/* logo */
	if ($logo_width> 220){
		$logo_width_mobile=220;
		$logo_height_mobile= floor(220*$logo_height/$logo_width);
	} else{
		$logo_width_mobile=$logo_width;
		$logo_height_mobile=$logo_height;
	}

	$neko_custom_styles.='a.brand {
		
		width:'.$logo_width_mobile.'px; height:'.$logo_height_mobile.'px; 
		background-size: 100%; 
		background-repeat:no-repeat; 
		background-position: center center;
	}';

	$neko_custom_styles.='a.brand span{margin-left:-3000px;}';
	
	$neko_custom_styles.=' @media(min-width:1024px){
		a.brand {width:'.$logo_width.'px; height:'.$logo_height.'px; margin:'.$header_padding.'px 0;} }';

		/* Regular logo */
		if('1' === $header_transparency){
			$neko_custom_styles.='
			a.brand {background-image:url("'.$logo.'")}';
		}else{
			$neko_custom_styles.='a.brand {background-image:url("'.$logo.'");}';

			$neko_custom_styles.='
			@media(min-width:1025px){
			#mainHeader:not(.scrolled):not(.navbar-static-top) a.brand {background-image:url("'.$logo_white.'"); }
			#mainHeader.scrolled a.brand {background-image:url("'.$logo.'");}
			}';


		}

		/* Retina logo */
		$neko_custom_styles.='@media
		only screen and (-webkit-min-device-pixel-ratio: 2),
		only screen and (min--moz-device-pixel-ratio: 2),
		only screen and (-o-min-device-pixel-ratio: 2/1),
		only screen and (min-device-pixel-ratio: 2),
		only screen and (min-resolution: 192dpi),
		only screen and (min-resolution: 2dppx){';

		if('1' === $header_transparency){
			$neko_custom_styles.='a.brand {background-image:url("'.$logo_retina.'"); }';
		}else{
			$neko_custom_styles.='a.brand {background-image:url("'.$logo_retina.'");}';
			$neko_custom_styles.='
			@media(min-width:1025px){
			#mainHeader:not(.scrolled):not(.navbar-static-top) a.brand {background-image:url("'.$logo_retina_white.'");}
			#mainHeader.scrolled a.brand {background-image:url("'.$logo_retina.'");}
			}';
		}
		
		$neko_custom_styles.='}';


		/*** side menu logo, max-width:250px ***/
		if ($logo_width> 250){
			$logo_width_side_menu=250;
			$logo_height_side_menu= floor(250*$logo_height/$logo_width);
			$neko_custom_styles.=' @media(min-width:768px){
				body.side-menu a.brand {width:'.$logo_width_side_menu.'px; height:'.$logo_height_side_menu.'px; } }';
			} 


			/*** hr ***/
			$neko_custom_styles.='hr.line, hr.dotted { border-color:'.$neutral_color.';}';


			/*** blog header ***/
			$neko_custom_styles.='.neko-page-blog:not(.single-post) .page-header, .search:not(.woocommerce-page) .page-header {';

			if ($blog_header_image){
				$neko_custom_styles.='background-image: url('.$blog_header_image.');';
				if('on' != $blog_header_parallax )
					$neko_custom_styles.='background-size: cover; background-repeat: no-repeat; background-position: center center;';
			}
			$neko_custom_styles.='}';



			$neko_custom_styles .= '@media(min-width:768px){';
			$neko_custom_styles.='.neko-page-blog .page-header, .search:not(.woocommerce-page) .page-header {';

			switch ($blog_header_size) {
				case 'small':
				$neko_custom_styles.='padding: 1em; }';
				break;
				case 'medium':
				$neko_custom_styles.='padding: 2em 1em; }';
				break;
				case 'large':
				$neko_custom_styles.='padding: 5em 2em; }';
				break;
			}
			$neko_custom_styles.='}';


			$neko_custom_styles .= '@media(min-width:1025px){';

			$neko_custom_styles.='.neko-page-blog .page-header, .search:not(.woocommerce-page) .page-header {';

			switch ($blog_header_size) {
				case 'small':
				$neko_custom_styles.='padding: 1em; }';
				break;
				case 'medium':
				$neko_custom_styles.='padding: 10em 2em; }';
				break;
				case 'large':
				$neko_custom_styles.='padding: 20em 5em; }';
				break;
			}
			$neko_custom_styles.='}';

			/* Blog header mask */
			if( !empty($blog_header_mask_opacity) && !empty($blog_header_mask_color) ){
				$neko_custom_styles.='.mask-active{position: relative; }';
				$neko_custom_styles.='.mask-active:before{ content:""; position:absolute; top:0; bottom:0; left:0; right: 0; background-color:'.$blog_header_mask_color .'; opacity:'.$blog_header_mask_opacity.'; }';	
			}

			/* Top Menu */
			$neko_custom_styles.='#mainHeader {min-height:'.$header_height_mobile.'px;}';
			$neko_custom_styles.='@media (min-width:1025px){ #mainHeader {min-height:'.$header_height.'px;} }';

			$neko_custom_styles.='
			@media(min-width:1025px){
			#main-menu ul li a {
				height:'.$header_height.'px;
				line-height:'.$header_height.'px;
				padding: 0 16px;
			}

			#mainHeader .social-network-bar li{
			height: '.$header_height.'px;
			line-height:'.$header_height.'px;
		}
	}';

	/* */


	/* mage menu */
	$neko_custom_styles.='.neko-mega-menu li.neko-menu-title > a{
		color:'.$accent_color.' !important;
	}';

	/* background */
	$neko_custom_styles.='#mainHeader {background-color: '.$header_background_color.'; }';
	$rgba_color = neko_hex2rgb($header_background_color);

	$neko_custom_styles.='
	@media(min-width:1025px){

		.header-transparent #mainHeader:not(.scrolled):not(.navbar-static-top){ 
			background-color:  rgba('.$rgba_color[0].','.$rgba_color[1].','.$rgba_color[2].', '.$header_transparency.');
			box-shadow:none; 
			border:none;
		}
	}';


	/*** main header menu ***/
	$neko_custom_styles.='#main-menu ul>li>a {
		color:'.$top_level_menu_text_color.';
	}';


	$neko_custom_styles.='
	#main-menu li.active > a, 
	#main-menu ul li.current-menu-item > a, 
	#main-menu ul li.current_page_parent > a,
	#main-menu ul li a:hover,  
	#main-menu li ul li.hover > a, 
	#main-menu ul li.Shover > a,
	.navbar-default .navbar-toggle:hover,
	.navbar-default .navbar-toggle:focus,
	.neko-dark-sub-menu #main-menu ul ul li>a:hover,
	.neko-dark-sub-menu #main-menu ul ul li.hover>a {
		color:'.$top_level_menu_text_color_hover.';
	}';
	
	/* sub menu */
	/* classic */
	$menu_margin_top= floor($header_height-32)/2;
	$neko_custom_styles.='
	@media(min-width:1025px){
		.header-classic #main-menu > ul > li:not(.action-link):not(.neko-cart-link) > a {
			margin-top:'.$menu_margin_top.'px;
			height:32px;
			line-height:32px;
			padding: 0 16px;
		}
	}
	.header-classic #main-menu li:not(.action-link):not(.neko-cart-link).active > a,
	.header-classic #main-menu ul li:not(.action-link):not(.neko-cart-link).current-menu-item > a,
	.header-classic #main-menu ul li:not(.action-link):not(.neko-cart-link).current-menu-ancestor > a,
	.header-classic #main-menu ul li:not(.action-link):not(.neko-cart-link).current_page_parent > a,
	.header-classic #main-menu ul li:not(.action-link):not(.neko-cart-link) a:hover,
	.header-classic #main-menu ul li:not(.action-link):not(.neko-cart-link).hover > a,
	.header-classic #main-menu ul li:not(.action-link):not(.neko-cart-link).Shover > a,
	.header-classic .navbar-default .navbar-toggle:hover,
	.header-classic .navbar-default .navbar-toggle:focus 
	{
		background-color:'.$top_level_menu_bg_color_hover.';
		color:'.$top_level_menu_text_color_hover.'!important;
	}';

	$neko_custom_styles.='
	@media(min-width:1025px){ 
	#main-menu .action-link{
		height: '.$header_height.'px;
	}
}';

/* modern */
$menu_modern_margin_top= ( $header_height - 12 ) / 2;
$neko_custom_styles.='
@media(min-width:1025px){

	.header-modern #main-menu > ul > li:not(.neko-cart-link) > a {
		margin-top:'.$menu_modern_margin_top.'px;
		margin-bottom:'.$menu_modern_margin_top.'px;
	}
	.header-modern #main-menu li.active > a,
	.header-modern #main-menu ul li.current-menu-item > a,
	.header-modern #main-menu ul li.current-menu-ancestor > a,
	.header-modern #main-menu ul li a:hover,
	.header-modern #main-menu ul li.hover > a,
	.header-modern #main-menu ul li.Shover > a,
	.header-modern .navbar-default .navbar-toggle:hover,
	.header-modern .navbar-default .navbar-toggle:focus
	{
		color:'.$top_level_menu_text_color_hover.';
	}

	.header-modern #main-menu li.active > a:before,
	.header-modern #main-menu ul > li.current-menu-item > a:before,
	.header-modern #main-menu ul > li.current-menu-ancestor > a:before,
	.header-modern #main-menu ul > li > a:hover:before,
	.header-modern #main-menu ul > li.hover > a:before,
	.header-modern #main-menu ul > li.Shover > a:before,
	.header-modern .navbar-default .navbar-toggle:hover:before,
	.header-modern .navbar-default .navbar-toggle:focus:before
	{
		opacity:1;
		background-color:'.$top_level_menu_text_color_hover.';
		-webkit-animation-name: bounceIn;
		animation-name: bounceIn;
	}

	.header-transparent.header-modern #mainHeader:not(.scrolled) #main-menu li.active > a:before,
	.header-transparent.header-modern #mainHeader:not(.scrolled) #main-menu ul li.current-menu-item > a:before,
	.header-transparent.header-modern #mainHeader:not(.scrolled) #main-menu ul li.current_page_parent > a:before,
	.header-transparent.header-modern #mainHeader:not(.scrolled) #main-menu ul li a:hover:before,
	.header-transparent.header-modern #mainHeader:not(.scrolled) #main-menu ul li.hover > a:before,
	.header-transparent.header-modern #mainHeader:not(.scrolled) #main-menu ul li.Shover > a:before,
	.header-transparent.header-modern #mainHeader:not(.scrolled) .navbar-default .navbar-toggle:hover:before,
	.header-transparent.header-modern #mainHeader:not(.scrolled) .navbar-default .navbar-toggle:focus:before
	{
		opacity:1;
		background-color:'.$top_level_menu_transparent_text_color_hover.';
		-webkit-animation-name: bounceIn;
		animation-name: bounceIn;
	}

	/*.header-modern #main-menu > ul > li > ul li a:hover{
		background-color:'.$top_level_menu_bg_color_hover.';
		color:'.$top_level_menu_text_color.';
	}*/
}';



/* header-centered-logo */

/* header-boxed */
$neko_custom_styles.='@media(min-width:1025px){';
$neko_custom_styles.='.header-boxed:not(.header-transparent) #mainHeader .navbar-default, .header-boxed.header-transparent #mainHeader.scrolled .navbar-default {background-color: '.$header_background_color.'; }';
$neko_custom_styles.='.header-boxed.header-transparent #mainHeader .navbar-default {background-color:  rgba('.$rgba_color[0].','.$rgba_color[1].','.$rgba_color[2].','.$header_transparency.')  }';
$neko_custom_styles.='}';


/* transparent menu */
$neko_custom_styles.='@media(min-width:1025px){';
$neko_custom_styles.='.header-transparent:not(.header-classic) #mainHeader:not(.scrolled):not(.navbar-static-top) #main-menu > ul > li:not(.active) > a { color:'.$top_level_menu_transparent_text_color.';}';
$neko_custom_styles.='
.header-transparent:not(.header-classic) #mainHeader:not(.scrolled):not(.navbar-static-top) #main-menu > ul > li.active > a,
.header-transparent:not(.header-classic) #mainHeader:not(.scrolled):not(.navbar-static-top) #main-menu > ul > li:not(.) > a:hover,
.header-transparent:not(.header-classic) #mainHeader:not(.scrolled):not(.navbar-static-top) #main-menu > ul > li.hover > a,
.header-transparent:not(.header-classic) #mainHeader:not(.scrolled):not(.navbar-static-top) #main-menu > ul > li.hover > a.hasSubMenu,
.header-transparent:not(.header-classic) #mainHeader:not(.scrolled):not(.navbar-static-top) #main-menu > ul > li.current-menu-item > a
{
	color:'.$top_level_menu_transparent_text_color_hover.';}';

	$neko_custom_styles.='}';


	/* form */
	$neko_custom_styles.='label span{color:'.$body_text_color.'}';
	$neko_custom_styles.='
	input[type="text"],
	input[type="search"],
	input[type="password"],
	input[type="email"],
	input[type="tel"],
	textarea,
	select,
	.page .widget input[type="text"],
	.page .widget input[type="password"],
	.page .widget input[type="email"],
	.page .widget input[type="tel"],
	.page .widget textarea,
	.page .widget select
	{ background-color: '.$post_background_color.'; color:'.$body_text_color.'; border-color:'.$neutral_color.';}';



	/*pages*/
	//$neko_custom_styles.='.page {background-color:'.$post_background_color.';}';
	$neko_custom_styles.='.page.home, .page.blog {background-color:'.$content_background_color.';}';


	/*blog and widgets*/
	$neko_custom_styles.='article.post, article.latestPost {background-color:'.$post_background_color.';}';

	$neko_custom_styles.='.pagination li>a, a .post-pagination-link {color:'.$body_text_color.';}';

	$neko_custom_styles.='.pagination li a, .post-pagination-link{ border-color:'.$neutral_color.'; color:'.$links_color.';}';
	$neko_custom_styles.='.pagination li>a:hover, .pagination li>span.current, .nav-links .current {background-color:'.$neutral_color.'; color:'.$links_color.';}';
	$neko_custom_styles.='h1.entry-title a:hover{color:'.$links_hover_color.';}';

	$neko_custom_styles.='.tagcloud a:link, .tagcloud a:visited, .entry-tags a:link, .entry-tags a:visited {border-color:'.$neutral_color.';}';
	$neko_custom_styles.='.tagcloud a:hover {background-color:'.$neutral_color.'; border-color:'.$body_text_color.';}';
	$neko_custom_styles.='#main-footer-wrapper .tagcloud a:link, #main-footer-wrapper .tagcloud a:visited { border-color:'.$footer_secondary_color.';}';
	$neko_custom_styles.='#main-footer-wrapper .tagcloud a:hover {background-color:'.$footer_secondary_color.'; border-color:'.$footer_secondary_color.';}';

	$neko_custom_styles.='.blog-grid article, .tab-content, .widget.neko_tabs li.active  {border-color:'.$neutral_color.';}';

	$neko_custom_styles.='
	.widget_nav_menu ul li a {
		color:'.$body_text_color.';}';

		$neko_custom_styles.='
		.widget_recent_entries ul li a,
		.widget_recent_comments ul li,
		.widget_archive ul li a,
		.widget_categories ul li a,
		.widget_meta ul li a,
		.widget_pages ul li a,
		.widget_nav_menu ul li a,
		.widget_nav_menu ul li:first-child a,
    .woocommerce-MyAccount-navigation ul li a  {
			border-color:'.$neutral_color.';}';

			$neko_custom_styles.='
			.widget_recent_entries ul li::before,
			.widget_recent_comments ul li::before,
			.widget_archive ul li::before,
			.widget_categories ul li::before,
			.widget_meta ul li::before,
			.widget_pages ul li::before,
			.widget_nav_menu ul li::before,
			.widget_recent_entries ul li a:hover,
			.widget_recent_comments ul li a:hover,
			.widget_archive ul li a:hover,
			.widget_categories ul li a:hover,
      .woocommerce-MyAccount-navigation ul li a:hover,
      .woocommerce-MyAccount-navigation ul li a:focus,
			.widget_meta ul li a:hover,
			.widget_pages ul li a:hover,
			.widget_nav_menu ul li a:hover, 
			.widget_recent_entries ul li a:focus,
			.widget_recent_comments ul li a:focus,
			.widget_archive ul li a:focus,
			.widget_categories ul li a:focus,
			.widget_meta ul li a:focus,
			.widget_pages ul li a:focus,
			.widget_nav_menu ul li a:focus  {
				color:'.$links_hover_color.';
			}';


			$neko_custom_styles.='.dateDay {font-family:'.$heading_font.';}';
			$neko_custom_styles.='.formatIcon {background-color: '.$body_text_color.';}';

			$neko_custom_styles.='#neko-preheader .widget_nav_menu ul:not(.social-network-bar) li a:hover { color:'.$accent_color.';}';

			/* calendar */

			$neko_custom_styles.='#wp-calendar tbody td, #calendar_wrap {border-color:'.$neutral_color.';}';
			$neko_custom_styles.='#wp-calendar tbody td a { color:'.$links_color.';}';
			$neko_custom_styles.='#wp-calendar tfoot td#prev a:hover,#wp-calendar tfoot td#next a:hover { color:'.$links_hover_color.';}';
			$neko_custom_styles.='#wp-calendar tbody td#today { color:'.$links_color.'; border-color:'.$links_hover_color.';}';


			$neko_custom_styles.='#main-footer-wrapper #main-footer #wp-calendar tbody td, #main-footer-wrapper #main-footer #calendar_wrap {border-color:'.$footer_secondary_color.';}';


			/* post metas*/
			$neko_custom_styles.=' ul.entry-meta li, ul.entry-meta li a { color:'.$body_text_color.'; }';
			$neko_custom_styles.=' ul.entry-meta li a:hover { color:'.$links_hover_color .'; }';


			/* author bio */

			$neko_custom_styles.='.neko-author-bio { border-color:'.$neutral_color .';}';
			$neko_custom_styles.='.neko-author-bio .author-icon li a i:before { border-color:'.$neutral_color .'; color:'.$body_text_color.'}';
			$neko_custom_styles.='.neko-author-bio .author-icon li a:hover i:before { border-color:'.$accent_color .'; color:'.$accent_color.'}';

			/* prev next */
			$neko_custom_styles.='.meta-nav{font-family:'.$heading_font.'; color: '.$body_text_color.';}';
			$neko_custom_styles.='.nav-links a { background-color:'.$btn_color.';  color:'.$btn_text_color.';}';
			$neko_custom_styles.='.nav-links a span{ color:'.$btn_text_color.'; }';
			$neko_custom_styles.='.nav-links a:hover { background-color:'.$btn_hover_color.'; border-color:'.$btn_hover_color.'; color:'.$btn_text_color.'; }';


			/* comments */
			$neko_custom_styles.='#comments-wrapper li { background-color:'.$post_background_color.'; }';
			$neko_custom_styles.='.reply{ border-color:'.$neutral_color.'; }';
			$neko_custom_styles.='.comment-time {color:'.$neutral_color.'; }';
			$neko_custom_styles.='code {color:'.$body_text_color.'}';
			/* post formats */

			$neko_custom_styles.='.format-link-wrapper {background-color:'.$accent_color.';}';
			$neko_custom_styles.='a.format-link-wrapper:hover.image-bg div {background-color:'.$accent_color.';}';

			/* search */

			$neko_custom_styles.='.search-result {background-color:'.$post_background_color.'; }';
			$neko_custom_styles.='#search-page-search  {background-color:'.$post_background_color.'; }';
			$neko_custom_styles.='#search-page-search input[type="text"]  {background-color:'.$content_background_color.'; }';


			/* bootstrap */
			$neko_custom_styles.='.progress-bar {background-color:'.$body_text_color.';}';


			/* Portfolio */

			$neko_custom_styles.='.neko-portfolio-isotope-item .item-content {background-color:'.$post_background_color.'; }';

			/* launch button */

			$neko_custom_styles.='#neko-ajax-content a.neko-portfolio-launch, nav.neko-portfolio-filter a { background-color:'.$btn_color.';  color:'.$btn_text_color.';}';
			$neko_custom_styles.='#neko-ajax-content a.neko-portfolio-launch:hover, nav.neko-portfolio-filter a:hover, nav.neko-portfolio-filter a.current { background-color:'.$btn_hover_color.';  color:'.$btn_hover_text_color.';}';
			$neko_custom_styles.='.neko-portfolio-single-nav.pager li > a:hover { background-color:'.$btn_hover_color.';  color:'.$btn_hover_text_color.';}';

			/* singles */
			$neko_custom_styles.='.neko-portfolio-fullwidth .container-fw > .row-fw > div:first-child { background-color:'.$accent_color.';  color:'.$post_background_color.';}';
			$neko_custom_styles.='.neko-portfolio-fullwidth .container-fw > .row-fw > div:first-child h1,
			.neko-portfolio-fullwidth .container-fw > .row-fw > div:first-child h2,
			.neko-portfolio-fullwidth .container-fw > .row-fw > div:first-child h3
			{ background-color:'.$accent_color.';  color:'.$post_background_color.';}';


			/* page header portfolio */
			$neko_custom_styles.='.neko-portfolio:not(.neko-portfolio-fullwidth) .neko-portfolio-single .item-header {border-color:'.$neutral_color.'; }';
			$neko_custom_styles.='.neko-portfolio-single .item-header h1 { font-size:'.$h2_size.'; font-weight:'.$h2_fontweight.'; font-style:'.$h2_fontstyle.'; '.$h2_letterspacing.' '.$h2_lettercase.'}';
			$neko_custom_styles.= '.neko-portfolio:not(.neko-portfolio-fullwidth) .neko-portfolio-single .item-header:after  { background-color:'.$neutral_color.';}';
			/* Preloader neko portfolio */
			$neko_custom_styles.='.preloader-portfolio{ background-color: '.$content_background_color.' } ';


			/* footer */
			$neko_custom_styles.='#main-footer-wrapper{
				background-color:'.$footer_background_color.';
				color:'.$footer_text_color.';
			}';

			$neko_custom_styles.='#main-footer-wrapper h3 {
				color:'.$footer_text_color.';
				border-color:'.$footer_secondary_color.';
			}';

			$neko_custom_styles.='#main-footer-wrapper li {
				border-color:'.$footer_secondary_color.';
			}';

			$neko_custom_styles.='#main-footer-wrapper a:not(#neko-to-top):link, #main-footer-wrapper a:not(#neko-to-top):visited, #main-footer-wrapper .widget li a:not(#neko-to-top):link, #main-footer-wrapper .widget li a:not(#neko-to-top){
				color:'.$footer_link_color.';
			}';

			$neko_custom_styles.='#main-footer-wrapper #copyright a:not(#neko-to-top):link, #main-footer-wrapper #copyright a:not(#neko-to-top):visited {
				color:'.$copyright_link_color.';
			}';


			$neko_custom_styles.='#main-footer-wrapper #copyright a:not(#neko-to-top):hover {
				color:'.$copyright_hover_link_color.';
			}';


			$neko_custom_styles.='#main-footer-wrapper .widget li a, #main-footer-wrapper .widget li a:before{
				border-color:'.$footer_secondary_color.';
			}';
			$neko_custom_styles.='#main-footer-wrapper .widget li a:before,
#main-footer-wrapper .widget #recentcomments li::before,
#main-footer-wrapper .widget.widget_categories li::before,
#main-footer-wrapper .widget.widget_archive li::before {
			color:'.$footer_secondary_color.';
		}';
		$neko_custom_styles.='#main-footer-wrapper a:not(#neko-to-top):hover, #main-footer-wrapper .widget li a:not(#neko-to-top):hover  {
			color:'.$footer_hover_link_color.';
		}';


		$neko_custom_styles.='#neko-to-top {border-color:'.$accent_color.'; background-color:'.$content_background_color .';}';
		/* Ai twitter feed styles */
		$neko_custom_styles.='#main-footer-wrapper .aiwidgetscss .tweet_author_name a, #main-footer-wrapper .widget .tweet_author_name a, #main-footer-wrapper .tweettext a, #main-footer-wrapper .widget .tweettext a{
			color:'.$footer_link_color.';
		}';

		$neko_custom_styles.='#main-footer-wrapper .tweettext, #main-footer-wrapper .widget .tweettext{
			color:'.$footer_text_color.';
		}';

		/* pricing tables */
		$neko_custom_styles.='
		.neko_pt_style_1 .nk-focus-plan h2, .nk-pricing-tables-container.neko_pt_style_1 .btn {background:'.$btn_color.'; color:'.$btn_text_color .';}';


// style 2
		$neko_custom_styles.='
		.neko_pt_style_2 .nk-focus-plan .nk-offer h2,
		.neko_pt_style_2 .nk-focus-plan .nk-price
		{background:'.$btn_color.'; color:'.$btn_text_color .';}';
		$neko_custom_styles.='
		.neko_pt_style_2 .nk-focus-plan p.nk-sign a.btn {background:'.$btn_color.'; color:'.$btn_text_color .';}';
		$neko_custom_styles.='
		.neko_pt_style_2 .nk-focus-plan p.nk-sign a.btn:hover {background:'.$btn_hover_color.'; color:'.$btn_hover_text_color.';}';


// style 3
		$neko_custom_styles.='
		.neko_pt_style_3 .nk-focus-plan h2 {background:'.$btn_text_color.'; color:'.$btn_color .';}';

		$neko_custom_styles.=
		'.neko_pt_style_3 .nk-focus-plan .nk-price:after {border-top-color:'.$btn_color.';}';

		$neko_custom_styles.='
		.neko_pt_style_3 .nk-focus-plan h3
		{background:'.$btn_color.'; color:'.$btn_text_color .';}';

		$neko_custom_styles.='
		.neko_pt_style_3 .nk-focus-plan p.nk-sign
		{background:'.$btn_color.'; color:'.$btn_text_color .';}';

		$neko_custom_styles.='
		.neko_pt_style_3 p.nk-sign a.btn {background:'.$btn_color.'; color:'.$btn_text_color .';}';
		$neko_custom_styles.='
		.neko_pt_style_3 p.nk-sign a.btn:hover {background:'.$btn_hover_color.'; color:'.$btn_hover_text_color.';}';

		$neko_custom_styles.='
		.neko_pt_style_3 .nk-focus-plan p.nk-sign a.btn {background:'.$btn_text_color.'; color:'.$btn_color .';}';
		$neko_custom_styles.='
		.neko_pt_style_3 .nk-focus-plan p.nk-sign a.btn:hover {background:'.$btn_hover_color.'; color:'.$btn_hover_text_color.';}';


// style 4
		$neko_custom_styles.='
		.neko_pt_style_4 .nk-focus-plan h2 {color:'.$btn_color .';}';

		$neko_custom_styles.='
		.neko_pt_style_4 .nk-focus-plan p.nk-sign a.btn {background:'.$btn_color.'; color:'.$btn_text_color .'; border-color:'.$btn_color.';}';


// style 5
		$neko_custom_styles.='
		.neko_pt_style_5 .nk-focus-plan { background:'.$btn_color.'; color:'.$btn_text_color .';}';

		$neko_custom_styles.='
		.neko_pt_style_5 .nk-focus-plan .nk-offer h2 { color:'.$btn_text_color .';}';

		$neko_custom_styles.='
		.neko_pt_style_5 .nk-focus-plan .nk-price h3 { color:'.$btn_color .';}';

		$neko_custom_styles.='
		.neko_pt_style_5 p.nk-sign a.btn {background:'.$btn_color.'; color:'.$btn_text_color .';}';
		$neko_custom_styles.='
		.neko_pt_style_5 p.nk-sign a.btn:hover {background:'.$btn_hover_color.'; color:'.$btn_hover_text_color.';}';

		$neko_custom_styles.='
		.neko_pt_style_5 .nk-focus-plan p.nk-sign a.btn {background:'.$btn_text_color.'; color:'.$btn_color .';}';
		$neko_custom_styles.='
		.neko_pt_style_5 .nk-focus-plan p.nk-sign a.btn:hover {background:'.$btn_hover_color.'; color:'.$btn_hover_text_color.';}';


// style 6
		$neko_custom_styles.='
		.neko_pt_style_6 .nk-focus-plan .nk-price h3 { color:'.$btn_color .';}';
		$neko_custom_styles.='
		.neko_pt_style_6 .nk-focus-plan p.nk-sign a.btn {background:'.$btn_color.'; color:'.$btn_text_color .';}';

		$neko_custom_styles.='
		.neko_pt_style_6 .nk-focus-plan p.nk-sign a.btn:hover {background:'.$btn_hover_color.'; color:'.$btn_hover_text_color .';}';

		$neko_custom_styles.='
		.neko_pt_style_6 p.nk-sign a.btn:hover {background:'.$btn_hover_color.'; color:'.$btn_hover_text_color .';}';

// style 7
		$neko_custom_styles.='
		.neko_pt_style_7 .nk-focus-plan h2, .neko_pt_style_7 .nk-focus-plan .nk-price h3 { color:'.$btn_color .';}';
		$neko_custom_styles.='
		.neko_pt_style_7 .nk-focus-plan p.nk-sign a.btn {background:'.$btn_color.'; color:'.$btn_text_color .';}';
		$neko_custom_styles.='
		.neko_pt_style_7 .nk-focus-plan p.nk-sign a.btn:hover, .neko_pt_style_7 p.nk-sign a.btn:hover {background:'.$btn_hover_color.'; color:'.$btn_hover_text_color .';}';


		/* credits */
		$neko_custom_styles.='#copyright{
			background-color:'.$copyright_background_color.';
			color:'.$copyright_text_color.';
		}';
		$neko_custom_styles.='#copyright a:not(#neko-to-top){
			color:'.$copyright_link_color.';
		}';
		$neko_custom_styles.='#copyright a:not(#neko-to-top):hover{
			color:'.$copyright_hover_link_color.';
		}';


		/* team */
		$neko_custom_styles.='.neko-team-skill-value {color:'.$body_text_color.';}';
		$neko_custom_styles.='.progress-bar {background:'.$accent_color.';}';


		/*** miscelanious ***/

		/* boxed layout */

		$neko_custom_styles.='.boxed-layout #global-wrapper {background-color : '.$post_background_color.' }';


		/* preloader */
		$neko_custom_styles.='#preloader{ background-color : '.$post_background_color.' }';

		if('circle' == $preloader_selector){
			$neko_custom_styles.= '.circle-loader:before{ background: linear-gradient('.$accent_color.', #ededed 60%); }';
		}

		if('signal' == $preloader_selector){
			$neko_custom_styles.= '.signal-loader{ border-color:'.$accent_color.' }';
		}

		if('dots' == $preloader_selector){
			$neko_custom_styles.= '
			.dots-loader i { background: '.$accent_color.'; }
			.dots-loader i:first-child { background: '.$neutral_color.'; }
			.dots-loader i:last-child { background: '.$accent_color.';}'; 
		}

		if('underline' == $preloader_selector){
			$neko_custom_styles.= '
			.underline-loader { color:'.$body_text_color.' }
			.underline-loader:after { background-color: '.$accent_color.'; }
			';
		}	
		/*** contact form 7 ***/
		$neko_custom_styles.='
		.wpcf7 input[type="text"].wpcf7-form-control,
		.wpcf7 input[type="password"].wpcf7-form-control,
		.wpcf7 input[type="email"].wpcf7-form-control,
		.wpcf7 input[type="tel"].wpcf7-form-control,
		.wpcf7 textarea.wpcf7-form-control,
		.wpcf7 select.wpcf7-form-control {
			border-bottom-color:'.$neutral_color.';
		}';

		$neko_custom_styles.='
		.wpcf7 input[type="text"].wpcf7-form-control:focus,
		.wpcf7 input[type="password"].wpcf7-form-control:focus,
		.wpcf7 input[type="email"].wpcf7-form-control:focus,
		.wpcf7 input[type="tel"].wpcf7-form-control:focus,
		.wpcf7 textarea.wpcf7-form-control:focus,
		.wpcf7 select.wpcf7-form-control:focus {
			border-bottom-color:'.$accent_color.';
		}';


		/*** visual composer styles ***/

		$neko_custom_styles.='[class*="vc_custom_"] {border-color:'.$neutral_color.';}';
		$neko_custom_styles.='a.vc_general.vc_btn3, button.vc_general.vc_btn3 { color:'.$btn_text_color.'; background-color:'.$btn_color.'; }';
		$neko_custom_styles.='a.vc_general.vc_btn3:hover, button.vc_general.vc_btn3:hover, a.vc_general.vc_btn3:focus, button.vc_general.vc_btn3:focus { color:'.$btn_hover_text_color.'; background-color:'.$btn_hover_color.'; }';

		/* tabs */
		$neko_custom_styles.='.vc_tta-style-theme.vc_tta.vc_general .vc_tta-panel-title > a, .vc_tta-style-theme.vc_tta-tabs .vc_tta-tabs-list {
			border-bottom-color:'.$neutral_color.';
		}';

		$neko_custom_styles.='.vc_tta-style-theme.vc_tta.vc_general  a:hover,
		.vc_tta-style-theme.vc_tta.vc_general .vc_active .vc_tta-panel-title a,
		.vc_tta-style-theme.vc_tta.vc_general .vc_tta-tab.vc_active > a{
			border-bottom-color: '.$accent_color.';
		}';

		$neko_custom_styles.='.vc_tta-style-theme.vc_tta.vc_general .vc_active  a >.vc_tta-title-text,
		.vc_tta-style-theme.vc_tta.vc_general  a:hover > .vc_tta-title-text
		{
			color:'.$accent_color.';
		}';

		$neko_custom_styles.='.vc_tta-style-theme.vc_tta.vc_general .vc_tta-panel-title a:after,
		.vc_tta-style-theme.vc_tta.vc_general .vc_tta-tab > a:after
		{
			background-color:'.$accent_color.';
		}';

		$neko_custom_styles.='.vc_tta-style-theme.vc_tta.vc_general .vc_tta-tab > a:hover:after
		{
			background-color:'.$body_text_color.';
		}';


		/* progress bar */
		$neko_custom_styles.='.vc_progress_bar .vc_single_bar .vc_bar { background-color:'.$accent_color.';}';

		/* accordions */
		$neko_custom_styles.='.neko-container .wpb_content_element .wpb_accordion_wrapper .wpb_accordion_header a {  border-bottom-color:'.$neutral_color.';}';
		$neko_custom_styles.='.neko-container .wpb_content_element .wpb_accordion_wrapper .wpb_accordion_header a:after { background-color:'.$accent_color.';}';

		/* cta box */
		$neko_custom_styles.='.neko-container .vc_general.vc_cta3.vc_cta3-style-custom {color:'.$btn_hover_text_color.'; background-color:'.$btn_hover_color.'; }';
		$neko_custom_styles.='.neko-container .vc_general.vc_cta3.vc_cta3-style-custom h2, .neko-container .vc_general.vc_cta3.vc_cta3-style-custom h4 {color:'.$btn_text_color.'; }';
		$neko_custom_styles.='.neko-container .vc_general.vc_cta3 h2 {font-size:'.$h1_size.'; }';
		$neko_custom_styles.='@media(min-width:1025px){';
		$neko_custom_styles.='.neko-vc_cta-box h2 {font-size:'.$h1_size.'; font-weight:'.$h1_fontweight.'; letter-spacing:'.$h1_letterspacing .'; }';
		$neko_custom_styles.='}';

		/* featured box */
		$neko_custom_styles.='i.rounded, i.squared, i.circle {color:'.$btn_text_color.'; background-color:'.$btn_color.'; }';

		/* lists icons */
		$neko_custom_styles.='.entry-content ul.neko-vc_list-icon-ul li i {color:'.$accent_color.';}';

		/* icon box */
		$neko_custom_styles.='.neko-vc_box-icon a .neko-vc_box-icon-content { color:'.$body_text_color.';}';
		$neko_custom_styles.='.neko-vc_box-icon a:hover .neko-vc_box-icon-content { color:'.$btn_hover_color.';}';


		/* Image grid */
		$neko_custom_styles.= '
		.border-grid .row .col-lg-1:not(:last-child),
		.border-grid .row .col-lg-10:not(:last-child),
		.border-grid .row .col-lg-11:not(:last-child),
		.border-grid .row .col-lg-12:not(:last-child),
		.border-grid .row .col-lg-2:not(:last-child),
		.neko-border-grid .row .col-lg-3:not(:last-child),
		.neko-border-grid .row .col-lg-4:not(:last-child),
		.neko-border-grid .row .col-lg-5:not(:last-child),
		.neko-border-grid .row .col-lg-6:not(:last-child),
		.neko-border-grid .row .col-lg-7:not(:last-child),
		.neko-border-grid .row .col-lg-8:not(:last-child),
		.neko-border-grid .row .col-lg-9:not(:last-child),
		.neko-border-grid .row .col-md-1:not(:last-child),
		.neko-border-grid .row .col-md-10:not(:last-child),
		.neko-border-grid .row .col-md-11:not(:last-child),
		.neko-border-grid .row .col-md-12:not(:last-child),
		.neko-border-grid .row .col-md-2:not(:last-child),
		.neko-border-grid .row .col-md-3:not(:last-child),
		.neko-border-grid .row .col-md-4:not(:last-child),
		.neko-border-grid .row .col-md-5:not(:last-child),
		.neko-border-grid .row .col-md-6:not(:last-child),
		.neko-border-grid .row .col-md-7:not(:last-child),
		.neko-border-grid .row .col-md-8:not(:last-child),
		.neko-border-grid .row .col-md-9:not(:last-child),
		.neko-border-grid .row .col-sm-1:not(:last-child),
		.neko-border-grid .row .col-sm-10:not(:last-child),
		.neko-border-grid .row .col-sm-11:not(:last-child),
		.neko-border-grid .row .col-sm-12:not(:last-child),
		.neko-border-grid .row .col-sm-2:not(:last-child),
		.neko-border-grid .row .col-sm-3:not(:last-child),
		.neko-border-grid .row .col-sm-4:not(:last-child),
		.neko-border-grid .row .col-sm-5:not(:last-child),
		.neko-border-grid .row .col-sm-6:not(:last-child),
		.neko-border-grid .row .col-sm-7:not(:last-child),
		.neko-border-grid .row .col-sm-8:not(:last-child),
		.neko-border-grid .row .col-sm-9:not(:last-child),
		.neko-border-grid .row .col-xs-1:not(:last-child),
		.neko-border-grid .row .col-xs-10:not(:last-child),
		.neko-border-grid .row .col-xs-11:not(:last-child),
		.neko-border-grid .row .col-xs-12:not(:last-child),
		.neko-border-grid .row .col-xs-2:not(:last-child),
		.neko-border-grid .row .col-xs-3:not(:last-child),
		.neko-border-grid .row .col-xs-4:not(:last-child),
		.neko-border-grid .row .col-xs-5:not(:last-child),
		.neko-border-grid .row .col-xs-6:not(:last-child),
		.neko-border-grid .row .col-xs-7:not(:last-child),
		.neko-border-grid .row .col-xs-8:not(:last-child),
		.neko-border-grid .row .col-xs-9:not(:last-child) {
			border-right-color: '.$neutral_color.';
		}
		.neko-border-grid .row .col-lg-1:last-child,
		.neko-border-grid .row .col-lg-10:last-child,
		.neko-border-grid .row .col-lg-11:last-child,
		.neko-border-grid .row .col-lg-12:last-child,
		.neko-border-grid .row .col-lg-2:last-child,
		.neko-border-grid .row .col-lg-3:last-child,
		.neko-border-grid .row .col-lg-4:last-child,
		.neko-border-grid .row .col-lg-5:last-child,
		.neko-border-grid .row .col-lg-6:last-child,
		.neko-border-grid .row .col-lg-7:last-child,
		.neko-border-grid .row .col-lg-8:last-child,
		.neko-border-grid .row .col-lg-9:last-child,
		.neko-border-grid .row .col-md-1:last-child,
		.neko-border-grid .row .col-md-10:last-child,
		.neko-border-grid .row .col-md-11:last-child,
		.neko-border-grid .row .col-md-12:last-child,
		.neko-border-grid .row .col-md-2:last-child,
		.neko-border-grid .row .col-md-3:last-child,
		.neko-border-grid .row .col-md-4:last-child,
		.neko-border-grid .row .col-md-5:last-child,
		.neko-border-grid .row .col-md-6:last-child,
		.neko-border-grid .row .col-md-7:last-child,
		.neko-border-grid .row .col-md-8:last-child,
		.neko-border-grid .row .col-md-9:last-child,
		.neko-border-grid .row .col-sm-1:last-child,
		.neko-border-grid .row .col-sm-10:last-child,
		.neko-border-grid .row .col-sm-11:last-child,
		.neko-border-grid .row .col-sm-12:last-child,
		.neko-border-grid .row .col-sm-2:last-child,
		.neko-border-grid .row .col-sm-3:last-child,
		.neko-border-grid .row .col-sm-4:last-child,
		.neko-border-grid .row .col-sm-5:last-child,
		.neko-border-grid .row .col-sm-6:last-child,
		.neko-border-grid .row .col-sm-7:last-child,
		.neko-border-grid .row .col-sm-8:last-child,
		.neko-border-grid .row .col-sm-9:last-child,
		.neko-border-grid .row .col-xs-1:last-child,
		.neko-border-grid .row .col-xs-10:last-child,
		.neko-border-grid .row .col-xs-11:last-child,
		.neko-border-grid .row .col-xs-12:last-child,
		.neko-border-grid .row .col-xs-2:last-child,
		.neko-border-grid .row .col-xs-3:last-child,
		.neko-border-grid .row .col-xs-4:last-child,
		.neko-border-grid .row .col-xs-5:last-child,
		.neko-border-grid .row .col-xs-6:last-child,
		.neko-border-grid .row .col-xs-7:last-child,
		.neko-border-grid .row .col-xs-8:last-child,
		.neko-border-grid .row .col-xs-9:last-child {
			border-right-color: transparent !important;
		}
		.neko-border-grid .row:not(:last-child) .col-lg-1,
		.neko-border-grid .row:not(:last-child) .col-lg-10,
		.neko-border-grid .row:not(:last-child) .col-lg-11,
		.neko-border-grid .row:not(:last-child) .col-lg-12,
		.neko-border-grid .row:not(:last-child) .col-lg-2,
		.neko-border-grid .row:not(:last-child) .col-lg-3,
		.neko-border-grid .row:not(:last-child) .col-lg-4,
		.neko-border-grid .row:not(:last-child) .col-lg-5,
		.neko-border-grid .row:not(:last-child) .col-lg-6,
		.neko-border-grid .row:not(:last-child) .col-lg-7,
		.neko-border-grid .row:not(:last-child) .col-lg-8,
		.neko-border-grid .row:not(:last-child) .col-lg-9,
		.neko-border-grid .row:not(:last-child) .col-md-1,
		.neko-border-grid .row:not(:last-child) .col-md-10,
		.neko-border-grid .row:not(:last-child) .col-md-11,
		.neko-border-grid .row:not(:last-child) .col-md-12,
		.neko-border-grid .row:not(:last-child) .col-md-2,
		.neko-border-grid .row:not(:last-child) .col-md-3,
		.neko-border-grid .row:not(:last-child) .col-md-4,
		.neko-border-grid .row:not(:last-child) .col-md-5,
		.neko-border-grid .row:not(:last-child) .col-md-6,
		.neko-border-grid .row:not(:last-child) .col-md-7,
		.neko-border-grid .row:not(:last-child) .col-md-8,
		.neko-border-grid .row:not(:last-child) .col-md-9,
		.neko-border-grid .row:not(:last-child) .col-sm-1,
		.neko-border-grid .row:not(:last-child) .col-sm-10,
		.neko-border-grid .row:not(:last-child) .col-sm-11,
		.neko-border-grid .row:not(:last-child) .col-sm-12,
		.neko-border-grid .row:not(:last-child) .col-sm-2,
		.neko-border-grid .row:not(:last-child) .col-sm-3,
		.neko-border-grid .row:not(:last-child) .col-sm-4,
		.neko-border-grid .row:not(:last-child) .col-sm-5,
		.neko-border-grid .row:not(:last-child) .col-sm-6,
		.neko-border-grid .row:not(:last-child) .col-sm-7,
		.neko-border-grid .row:not(:last-child) .col-sm-8,
		.neko-border-grid .row:not(:last-child) .col-sm-9,
		.neko-border-grid .row:not(:last-child) .col-xs-1,
		.neko-border-grid .row:not(:last-child) .col-xs-10,
		.neko-border-grid .row:not(:last-child) .col-xs-11,
		.neko-border-grid .row:not(:last-child) .col-xs-12,
		.neko-border-grid .row:not(:last-child) .col-xs-2,
		.neko-border-grid .row:not(:last-child) .col-xs-3,
		.neko-border-grid .row:not(:last-child) .col-xs-4,
		.neko-border-grid .row:not(:last-child) .col-xs-5,
		.neko-border-grid .row:not(:last-child) .col-xs-6,
		.neko-border-grid .row:not(:last-child) .col-xs-7,
		.neko-border-grid .row:not(:last-child) .col-xs-8,
		.neko-border-grid .row:not(:last-child) .col-xs-9 {
			border-bottom-color:  '.$neutral_color.';
		}
		';

		/* Woo commerce */
		/* item */

		$neko_custom_styles.='
		.woocommerce div.product p.price,
		.woocommerce div.product span.price,
		.woocommerce ul.products li.product .price,
		.woocommerce .woocommerce-breadcrumb a
		{ color:  '.$accent_color.';}';
		$neko_custom_styles.='
		.woocommerce div.product p.price del,
		.woocommerce div.product span.price del,
		.woocommerce-review-link:link,
		.woocommerce-review-link:visited,
		.woocommerce ul.products li.product .price del
		{ color:  '.$body_text_color.';}';

		$neko_custom_styles.='.upsells.products, .related.products {
			border-color:  '.$neutral_color.';}';

		$neko_custom_styles.='
		.woocommerce #respond input#submit.alt,
		.woocommerce a.button.alt,
		.woocommerce button.button.alt,
		.woocommerce input.button.alt,
		.woocommerce ul.products li.product .button,
		.woocommerce #respond input#submit,
		.woocommerce a.button,
		.woocommerce button.button,
		.woocommerce input.button
		{ background-color:  '.$btn_color.'; color:  '.$btn_text_color.';}';
		$neko_custom_styles.='
		.woocommerce #respond input#submit.alt:hover,
		.woocommerce a.button.alt:hover,
		.woocommerce button.button.alt:hover,
		.woocommerce input.button.alt:hover,
		.woocommerce ul.products li.product .button:hover
		{ background-color:  '.$btn_hover_color.'; color:  '.$btn_hover_text_color.';}';

		$neko_custom_styles.='
		.woocommerce #respond input#submit.alt.disabled,
		.woocommerce #respond input#submit.alt.disabled:hover,
		.woocommerce #respond input#submit.alt:disabled,
		.woocommerce #respond input#submit.alt:disabled:hover,
		.woocommerce #respond input#submit.alt:disabled[disabled],
		.woocommerce #respond input#submit.alt:disabled[disabled]:hover,
		.woocommerce a.button.alt.disabled,
		.woocommerce a.button.alt.disabled:hover,
		.woocommerce a.button.alt:disabled,
		.woocommerce a.button.alt:disabled:hover,
		.woocommerce a.button.alt:disabled[disabled],
		.woocommerce a.button.alt:disabled[disabled]:hover,
		.woocommerce button.button.alt.disabled,
		.woocommerce button.button.alt.disabled:hover,
		.woocommerce button.button.alt:disabled,
		.woocommerce button.button.alt:disabled:hover,
		.woocommerce button.button.alt:disabled[disabled],
		.woocommerce button.button.alt:disabled[disabled]:hover,
		.woocommerce input.button.alt.disabled,
		.woocommerce input.button.alt.disabled:hover,
		.woocommerce input.button.alt:disabled,
		.woocommerce input.button.alt:disabled:hover,
		.woocommerce input.button.alt:disabled[disabled],
		.woocommerce input.button.alt:disabled[disabled]:hover
		{ background-color:  '.$neutral_color.'; color:  '.$body_text_color.';}';

		/* cart */
		$neko_custom_styles.='
		.woocommerce-cart table.cart th,
		.woocommerce-cart table.cart td,
		.woocommerce .cart-collaterals .cart_totals,
		.woocommerce-page .cart-collaterals .cart_totals,
		.woocommerce-account .col-1.address,
		.woocommerce-account .col-2.address,
		.woocommerce-account .addresses .title .edit
		{ border-color: '.$neutral_color.'; }';

		$neko_custom_styles.='
		.woocommerce .coupon input.button,
		.woocommerce input.button[name=update_cart],
		#main-menu ul>li.wpmenucartli > a 
		{ background-color: '.$body_text_color.'; color: '.$content_background_color.'; }';

		$neko_custom_styles.='
		.woocommerce .coupon input.button:hover,
		.woocommerce input.button[name=update_cart]:hover,
		#main-menu ul>li.wpmenucartli > a:hover,
		.header-classic #main-menu ul li:not(.action-link).wpmenucartli a:hover
		{ background-color: '.$btn_hover_color.'; color: '.$btn_hover_text_color .'; }';

		$neko_custom_styles.='
		.header-classic #main-menu ul li:not(.action-link).wpmenucartli a:hover
		{ color: '.$btn_hover_text_color .'!important; }';

		$menu_modern_header_height = $header_height-20;
		$neko_custom_styles.='
		@media(min-width:1025px){
			#main-menu ul li.wpmenucartli a {
			height:'.$menu_modern_header_height.'px;
			line-height:'.$menu_modern_header_height.'px;
		}';

		$menu_modern_margin_top_shop=$menu_modern_margin_top-10;

		$neko_custom_styles.='.header-modern #main-menu > ul > li.wpmenucartli > a {
			margin-top:'.$menu_modern_margin_top_shop.'px;
			margin-bottom:'.$menu_modern_margin_top_shop.'px;
		}}';
		/* end cart */

		/* widgets */
		
		$neko_custom_styles.=
		'.woocommerce.widget_product_categories li a  {
			border-color:'.$neutral_color.';
		}';

		$neko_custom_styles.=
		'.woocommerce.widget_price_filter .price_slider_wrapper .ui-widget-content {
			background-color:'.$neutral_color.';
		}';

		$neko_custom_styles.=
		'.woocommerce .widget_price_filter .ui-slider .ui-slider-range {
			background-color:'.$accent_color.';
		}';

		$neko_custom_styles.=
		'.woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
			background-color:'.$accent_color.';
			border-color:'.$post_background_color.';
		}';

		/* end widgets */

		/* end woo commerce */

		/* Custom css */
		$neko_custom_styles .= html_entity_decode($customizerOptions['custom_css']);

		/* Custom css rendering */
		$neko_custom_styles = neko_compress( $neko_custom_styles );
		return $neko_custom_styles;

	}

/**
* Minify CSS
*/
if(!function_exists('neko_compress')){
	function neko_compress($buffer) {
		/* remove comments */
		$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
		/* remove tabs, spaces, newlines, etc. */
		$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
		return $buffer;
	}
}

?>