<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package valkostur
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

<?php
while ( have_posts() ) : the_post();
	get_template_part( 'template-parts/content', 'page' );
endwhile; // End of the loop.


// If page has another template, use that instead
if( $post->post_parent !== 0 ) {
    get_template_part('matsedlar', 'child');
} else {
    get_template_part('matsedlar');
}

// Return button
if ( $post->post_parent ) { ?>
<form action="<?php echo get_permalink( $post->post_parent ); ?>">
    <input  id="submit" type="submit" value="Til baka" />
</form>
<?php } ?>

	</main><!-- #main -->
</div><!-- #primary -->


<?php
get_footer();
