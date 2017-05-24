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

<?php

$args = array(
	'post_type' => 'page',
	'post_parent' => $post->ID,
	'posts_per_page' => -1
	);

$menus = new WP_Query($args);

	if ($menus->have_posts()){
		while($menus->have_posts()) : $menus->the_post(); ?>
			<div class="matsedlar-container">
				<?php
				echo "<a href=" . get_permalink() . "><img class='matsedlar-img' src=" . get_the_post_thumbnail() . "</a>"; ?>
				<div class="entry-wrap">
					<h1 class="entry-title"><?php the_title(); ?></h1> 
		            <div class="entry-content">
		                <?php the_excerpt(); ?> 
		        	</div>
	            </div>
	         </div>
		<?php endwhile;
	}

?>

<?php
get_footer();
?>