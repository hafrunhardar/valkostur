<?php
/**
 * The template for displaying all pages.
**/
get_header();
?>

<body <?php body_class(); ?> 

	<?php 
		$fp_id = get_option( 'page_on_front' );
		$feat_image = wp_get_attachment_url( get_post_thumbnail_id($fp_id) ); 
	?>

	style="background: url(<?php echo $feat_image; ?>) no-repeat center center fixed;
  		-webkit-background-size: cover;
  		-moz-background-size: cover;
  		-o-background-size: cover;
  		background-size: cover;">
<?php
do_action('skeleton_before_content');
get_template_part( 'loop', 'page' );
do_action('skeleton_after_content');
get_sidebar('page');
get_footer();
?>