 (function($) {
 	"use strict";

 	if($('.custom-network-main-wrapper').length){

 		/**
 		 * Add a new bloc custom social network to user profile page
 		 */
	 	$('#add-custom-network button').click(function(event) {
	 		event.preventDefault();
	 		var count = $('.custom-network-wrapper').length;
	 		//alert($('.custom-network-wrapper:first-child').clone().find("input").val());
	 		var $clone = $('.custom-network-wrapper:first-child').clone();
	 		$clone.incrementpost({ indexArray: count++ });
	 		$clone.find("input:text").val('').end();
	 		$clone.appendTo('.custom-network-main-wrapper');
	 	});


	 	$.fn.incrementpost = function(variables) {
	 		return this.each(function() {
	 			this.innerHTML = this.innerHTML.replace(/([0-9]+)/g, function(match, variable) {
	 				return variables.indexArray;
	 			});
	 			return this;
	 		});
	 	};

	 	/**
	 	 * Delete a custom social network bloc
	 	 */
	 	
	 	$('.custom-network-main-wrapper').on('click', '.delete-bloc',function(event) {
	 	 	event.preventDefault();
	 	 	var $this = $(this),
	 	 	$parent = $this.parents('.custom-network-wrapper');

	 	 	if($('.custom-network-wrapper').length > 1){
	 	 		$parent.fadeOut('fast', function() {
	 	 			$parent.remove();
	 	 		});	
	 	 	}else{
	 	 		$('.custom-network-wrapper').find("input:text").val('').end();
	 	 	}
	 	});

 	}


 	$('#neko-theme-registration-btn').click(function(event) {
 		event.preventDefault();
 		$('#neko-registration-result').hide();
 		var form = jQuery("#neko-theme-registration-frm");
 		var data = form.serialize();

 		$.ajax({
 			url: ajaxurl,
 			data: data,
 			dataType: "HTML",
 			type:"POST",
 			success: function(result){
 				$('#neko-registration-result').html(result); 
 				$('#neko-registration-result').show();
 			}
 		});


 	});


 	$('#neko-ajax-updater').click(function(event) {
 		event.preventDefault();

 		var data = {
 			action: 'upgrade-theme'
 		};

 		$.ajax({
 			url: ajaxurl,
 			data: data,
 			dataType: "HTML",
 			type:"POST",
 			success: function(result){
 				console.log(result);
 			}
 		});

 	});
 	

 })(jQuery); //END DOC READY