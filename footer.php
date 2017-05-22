<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Edena
 * @since Edena 1.0
 */
?>

<?php  
$customizerOptions = thsp_cbp_get_options_values();
$footer_layout = $customizerOptions['footerlayout'];
$footer_type = $customizerOptions['footertype'];
?>


<!-- footer -->
<footer id="main-footer-wrapper" class="neko-footer">
	<?php if( !empty($footer_type) && 'none' !== $footer_type ){  ?>
		<div  id="main-footer">
			<div class="container">
				<div class="row">
					<?php 
						switch ($footer_layout){

							case 'full':
							echo 
							'<div class="col-sm-12">'.neko_get_dynamic_sidebar('footer-area-1').'</div>';
							break;

							case '3cols':
							echo 
							'<div class="col-md-4">'.neko_get_dynamic_sidebar('footer-area-1').'</div>
							 <div class="col-md-4">'.neko_get_dynamic_sidebar('footer-area-2').'</div>
							 <div class="col-md-4">'.neko_get_dynamic_sidebar('footer-area-3').'</div>';
							break;


							case '4cols':
							echo 
							'<div class="col-md-3 col-sm-6">'.neko_get_dynamic_sidebar('footer-area-1').'</div>
							 <div class="col-md-3 col-sm-6">'.neko_get_dynamic_sidebar('footer-area-2').'</div>
							 <div class="col-md-3 col-sm-6">'.neko_get_dynamic_sidebar('footer-area-3').'</div>
							 <div class="col-md-3 col-sm-6">'.neko_get_dynamic_sidebar('footer-area-4').'</div>';
							break;

							case '2tier1tier':
							echo 
							'<div class="col-md-8">'.neko_get_dynamic_sidebar('footer-area-1').'</div>
							 <div class="col-md-4">'.neko_get_dynamic_sidebar('footer-area-2').'</div>';
							break;

							case '1tier2tier':
							echo 
							'<div class="col-md-4">'.neko_get_dynamic_sidebar('footer-area-1').'</div>
							 <div class="col-md-8">'.neko_get_dynamic_sidebar('footer-area-2').'</div>';
							break;

							case '1demi1demi':
							echo 
							'<div class="col-md-6 col-sm-6">'.neko_get_dynamic_sidebar('footer-area-1').'</div>
							 <div class="col-md-6 col-sm-6">'.neko_get_dynamic_sidebar('footer-area-2').'</div>';
							break;

							default:			
							$col_content = 
							'<div class="col-sm-12">'.neko_get_dynamic_sidebar('footer-area-1').'</div>';
							break;

						}

					 ?>
				</div>
			</div>
		</div>
	<?php } ?>


	<?php if ($customizerOptions['copyright']=='on'){?>
	<div id="copyright">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<p>
						<?php echo wp_kses_post($customizerOptions['copyright_text']);?></p>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>

</footer>
<!-- footer -->



</div>
<!-- #globalWrapper -->

<?php wp_footer(); ?>
</body>
</html>