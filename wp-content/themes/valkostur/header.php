<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section 
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package valkostur
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link href="http://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>

<?php wp_head(); ?>
</head>

<!-- Background on the body -->
<body <?php body_class(); ?> 
	style="background: url(<?php echo get_attachment_url_by_slug( 'background' ); ?>) no-repeat center center fixed;
  		-webkit-background-size: cover;
  		-moz-background-size: cover;
  		-o-background-size: cover;
  		background-size: cover;">

<div class="page-row">
	<div class="col-2"></div>
	<div id="page" class="col-8 site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'valkostur' ); ?></a>

		<header id="masthead" class="site-header" role="banner">
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
				</nav>
		</header>

		<input type="checkbox" id="nav-trigger" class="nav-trigger" />
		<label for="nav-trigger"></label>


<div id="content" class="site-content"> 
	<?php if (has_post_thumbnail( $post->ID ) ): ?>
	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
		$description = get_bloginfo( 'description', 'display' );
	?>
	<div id="banner" class="site-banner">
 	 	<?php echo '<img class="banner-img" src="'.$image[0].'" alt="site-banner">'?>
		<h2 class="banner-text"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?> <br /> <?php echo $description; ?></a></h2>

	</div>
<?php endif; ?>
