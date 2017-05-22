<?php

if(file_exists(get_template_directory() . '/framework/classes/neko-metabox-tax-generator/engine/Tax-meta-custom-class.php')){

	require_once(get_template_directory() . '/framework/classes/neko-metabox-tax-generator/engine/Tax-meta-custom-class.php');

	if ( ! class_exists( 'Neko_Tax_Meta_Class') ){

		class Neko_Tax_Meta_Class extends Tax_Meta_Class{


			public function __contruct( $meta_box ){
				parent::__construct( $meta_box ); 
			}


		   /**
		   * Show Field Shortcode.
		   * @author Thomas Bechier
		   * @param string $field 
		   * @since 0.1.3
		   * @access public
		   */
		   public function show_field_shortcode( $field, $meta ) {  

		   	$terms = get_term($_GET['tag_ID'], $field['taxonomy']);
		   	$value = '<span>'.esc_html__('Shortcode to copy in your page or post', 'neko').' :</span>&nbsp;&nbsp;&nbsp;<input type="text" class="shortcode-selector" value=\'['.$field['shortcodename'].' slug="'.$terms->slug.'" ]\' />';	

		   	/* $this->show_field_begin( $field, $meta ); */
		   	echo "<p class='{$field['class']}'>".$value."</p>";
		   	/* $this->show_field_end( $field, $meta ); */

		   } 


		  /**
		   *  Add Shortcode to meta box
		   *  @author Thomas Bechier
		   *  @since 0.1.3
		   *  @access public
		   *  @param $id string  field id, i.e. the meta key
		   *  @param $value paragraph html
		   *  @param $repeater bool  is this a field inside a repeatr? true|false(default) 
		   */
		  public function addShortcodeTxt($id,$args, $class='', $repeater=false){
		  	$new_field = array('type' => 'shortcode','id'=> $id,'value' => '','class' =>$class, 'std' => '', 'multiple' => false);
		  	$new_field = array_merge($new_field, $args);
		  	if(false === $repeater){
		  		$this->_fields[] = $new_field;
		  	}else{
		  		return $new_field;
		  	}
		  }


		}/* END OF CLASS */

	} /* End Check Class Exists */





}




