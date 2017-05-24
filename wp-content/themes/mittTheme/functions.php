<?php

function valkostur_resources() {
	
	wp_enqueue_style('style', get_stylesheet_uri());
	
}

add_action('wp_enqueue_scripts', 'valkostur_resources');


// Add featured image support
function mittTheme_setup() {

	// Navigation Menus
	register_nav_menus(array(
		'primary' => __( 'Primary Menu'),
		'footer' => __( 'Footer Menu')
	));


	add_theme_support('post-thumbnails');
	//add_image_size('small-thumbnail', 180, 120, true);
	//add_image_size('background-images', 2000, 2000, true);
}

add_action('after_setup_theme', 'mittTheme_setup');