<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package valkostur
 */
?>

	</div><!-- #content -->
	</div><!-- #page -->

</div><!-- #page-row -->

<div class="page-row">
	<footer id="site-footer" class="col-12 secondary">
		<div id="footer-sidebar1" class="col-12">
			<h3>Fylgstu með okkur:</h3>
			<a href="https://www.facebook.com/" class="footer-link"> <img src="<?php echo get_attachment_url_by_slug( '1494552366_facebook' ) ?>" alt="Facebook"></a>
			<a href="https://www.instagram.com/" class="footer-link"> <img src="<?php echo get_attachment_url_by_slug( '1494552382_instagram' ) ?>" alt="Instagram"></a>
			<a href="http://valkostur.com/?page_id=49" class="footer-link"> <img src="<?php echo get_attachment_url_by_slug( '1494554247_mail' ) ?>" alt="Hafa samband"></a>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
