<?php
/**
 * @package Skeleton WordPress Theme Framework
 * @subpackage skeleton
 * @author Simple Themes - www.simplethemes.com
 *
 * Layout Hooks:
 *
 * skeleton_above_header // Opening header wrapper
 * skeleton_header // header tag and logo/header text
 * skeleton_header_extras // Additional content may be added to the header
 * skeleton_below_header // Closing header wrapper
 * skeleton_navbar // main menu wrapper
 * skeleton_before_content // Opening content wrapper
 * skeleton_after_content // Closing content wrapper
 * skeleton_before_sidebar // Opening sidebar wrapper
 * skeleton_after_sidebar // Closing sidebar wrapper
 * skeleton_footer // Footer
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, skeleton_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage skeleton
 * @since skeleton 2.0
 */

function my_custom_creditlink(){
 	$credits = 'Site by <a href="http://facebook.com/hafrunhardar">Hafrún Harðardóttir</a>';
 	return $credits;
}
add_filter('skeleton_author_credits','my_custom_creditlink');


// For completely overriding the theme options and removal of inline styles
// You must dequeue custom.css and redeclare these styles in your child theme
//
add_action( 'wp_enqueue_scripts', 'remove_theme_options', 11);
function remove_theme_options() {
     wp_dequeue_style( 'skeleton-custom' );
}



/*-----------------------------------------------------------------------------------*/
// Hookable theme option field to add add'l content to header
// such as social icons, phone number, widget, etc...
// Child Theme Override: skeleton_child_header_extras();
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'skeleton_header_extras' ) ) {

	function skeleton_header_extras() {
		$header_extras = skeleton_options('header_extras');
		if ($header_extras) {
			$extras = "<div class=\"header_extras\">";
			$extras .= $header_extras;
			$extras .= "</div>";
			echo apply_filters ('skeleton_child_header_extras',$extras);
		}
	    
	    if(have_posts()) :
	        while (have_posts()) : the_post();
	            the_post_thumbnail();  
	        endwhile;        
	    endif;
	}
	add_action('skeleton_header','skeleton_header_extras', 3);

}


/*-----------------------------------------------------------------------------------*/
/* Header Logo
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'skeleton_logo' ) ) {

	function skeleton_logo() {
			
	}
	add_action('skeleton_header','skeleton_logo', 4);

}


/*-----------------------------------------------------------------------------------*/
/* Navigation Hook (navbar)
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'skeleton_main_menu' ) ) {

	function skeleton_main_menu() {

		echo '<nav class="fpNav">';
		wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary'));
		echo '</nav><!--/#navigation-->';
	}

	add_action('navbar','skeleton_main_menu', 1);

}


/*-----------------------------------------------------------------------------------*/
/* Gets one paragraph from page
/*-----------------------------------------------------------------------------------*/

function para_excerpt($text, $raw_excerpt) {
    if( ! $raw_excerpt ) {
        $content = apply_filters( 'the_content', get_the_content() );
        $text = substr( $content, 0, strpos( $content, '</p>' ) + 4 );
    }
    $text = preg_replace("/<img[^>]+\>/i", "", $text); 
    return $text;
}
add_filter( 'wp_trim_excerpt', 'para_excerpt', 10, 2 );