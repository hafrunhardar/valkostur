<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div id="insta-pics">
				<?php
				if(is_active_sidebar('insta-pics')){
					dynamic_sidebar('insta-pics');
				}
				?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
