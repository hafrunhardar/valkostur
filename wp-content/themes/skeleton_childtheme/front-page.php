<?php 
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


<div id="fpWrap">
	<div class="fpTextArea">
		<h1><?php echo get_bloginfo(); ?></h1>
		<h2><?php echo get_bloginfo('description'); ?></h2>
	</div>
</div>  	


<?php

do_action('navbar');
get_footer();

?>