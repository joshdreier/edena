<?php

class Neko_Menu_Walker_Nav_Menu extends Walker_Nav_Menu {

	
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		
		//In a child UL, add the 'dropdown-menu' class
		$indent = str_repeat( "\t", $depth );
		$output	   .= "\n$indent<ul class=\"subMenu\">\n";
		
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$li_attributes = '';
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		
		//Add class and attribute to LI element that contains a submenu UL.
		if ( $depth === 0){
			$classes[] = 'primary';
		}	


		/* Count number of children */
		/*		
			$locations = get_nav_menu_locations();
			$menu = wp_get_nav_menu_object( $locations['primary'] );
	    $menu_items = wp_get_nav_menu_items($menu->term_id);
			$count = 0;
			foreach( $menu_items as $menu_item ){
				if( $menu_item->menu_item_parent == $item->ID ){
					$count++;     
				}       
			}
		*/
		/* / Count number of children */

	
		$classes[] = 'menu-item-' . $item->ID;
		//If we are on the current page, add the active class to that menu item.
		$classes[] = ($item->current) ? 'active' : '';

		$classes[] = ( !empty( $item->megamenu ) ) ? 'neko-mega-menu' : '';
		$classes[] = ( !empty( $item->megamenu ) && empty( $item->megamenunbcols ) ) ? 'neko-mega-menu neko-mega-cols-4' : '';
		$classes[] = ( !empty( $item->megamenu ) && !empty( $item->megamenunbcols ) ) ? 'neko-mega-menu neko-mega-cols-'.$item->megamenunbcols : '';

		$classes[] = ( !empty( $item->menulinktitle ) && 1 == $depth ) ? 'neko-menu-title' : '';

		//Make sure you still add all of the WordPress classes.
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';


		//Add attributes to link element.
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';


		$item->url = ( !empty( $item->menulinktitle ) ) ? '' : $item->url ;
		$attributes .= ! empty( $item->url ) ? ' href="'. esc_attr( $item->url ) .'"' : '';

		$attributes .= ($args->has_children) ? ' class="hasSubMenu"' : ''; 

		$item_output  = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		//$item_output .= ($args->has_children) ? ' <b class="caret"></b> ' : ''; 
		$item_output .= '</a>';

		/* get widget from sidebar if depth = 1 and widget linked */
		if( !empty( $item->menuwidget ) && 1 == $depth ){
			$item_output .= neko_get_dynamic_sidebar($item->menuwidget);
		}
		/* get widget from sidebar if depth = 1 and widget linked */

		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	//Overwrite display_element function to add has_children attribute. Not needed in >= Wordpress 3.4
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		
		if ( !$element )
			return;
		
		$id_field = $this->db_fields['id'];

		//display this element
		if ( is_array( $args[0] ) ) 
			$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
		else if ( is_object( $args[0] ) ) 
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] ); 
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'start_el'), $cb_args);

		$id = $element->$id_field;

		// descend only when the depth is right and there are childrens for this element
		if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

			foreach( $children_elements[ $id ] as $child ){

				if ( !isset($newlevel) ) {
					$newlevel = true;
					//start the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
				}
				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
				unset( $children_elements[ $id ] );
		}

		if ( isset($newlevel) && $newlevel ){
			//end the child delimiter
			$cb_args = array_merge( array(&$output, $depth), $args);
			call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
		}

		//end this element
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'end_el'), $cb_args);
		
	}

	public static function neko_empty_menu(){
		echo '<div id="main-menu" class="collapse navbar-collapse navbar-right"><ul class="nav navbar-nav"><li><a href="' . home_url( '/' ) . 'wp-admin/nav-menus.php">Assign a Menu</a></li></ul></div>';
	}
	
}

?>