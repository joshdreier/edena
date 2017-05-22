jQuery(window).load(function($) {

	"use strict"

	
	jQuery('#accordion-section-typography_section').click(function (e) {

	 	if(jQuery('.accordion-section-content', this).css('display') == 'block'){

	 		jQuery('select[data-customize-setting-link="thsp_cbp_theme_options[heading_font]"]').change();
	 		jQuery('select[data-customize-setting-link="thsp_cbp_theme_options[body_font]"]').change();
	 	}

	});


	jQuery('select[data-customize-setting-link="thsp_cbp_theme_options[heading_font]"], select[data-customize-setting-link="thsp_cbp_theme_options[body_font]"]').on('change', function() {

		var $fontFamilly = jQuery(this).val(),
		$weight          = _wpCustomizeSettings.settings['neko_fontWeights']['value'][$fontFamilly],
		$selector        = jQuery(this).data('customize-setting-link'),
		$target          = {};	


		if($selector === 'thsp_cbp_theme_options[heading_font]'){

			$target = jQuery('input[data-customize-setting-link="thsp_cbp_theme_options[h1_font_weight]"], input[data-customize-setting-link="thsp_cbp_theme_options[h2_font_weight]"]');

		}else if($selector === 'thsp_cbp_theme_options[body_font]'){

			$target = jQuery('input[data-customize-setting-link="thsp_cbp_theme_options[body_font_weight]"]');

		}

		$target.each(function() {
			if(jQuery.inArray(jQuery(this).val(), $weight) < 0) {
				jQuery(this).parent().hide();
			}else{
				jQuery(this).parent().show();
			}
		});
		
  	});


});