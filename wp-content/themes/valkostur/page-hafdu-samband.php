<?php
get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		// While page has posts, display them
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', 'page' );
		endwhile; ?>

		<form action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>" method="POST">
			Nafn: <input type="text" name="contact_name" required="" "><br>
			Símanúmer: <input type="number" name="contact_mobile" pattern="[4-9]{1}[0-9]{6}"><br>
			Tölvupóstur: <input type="email" name="contact_email" required><br>
			Skilaboð: <textarea name="contact_message" required></textarea>
			<input type="submit" name="submit" value="Senda">
		</form>

		<?php 
		// if submit button is pressed, send message
		$submit = $_POST;
		if($submit) {

			$name = filter_var($_POST['contact_name'], FILTER_SANITIZE_STRING);
			$mobile = filter_var($_POST['contact_mobile'], FILTER_VALIDATE_INT);
			$email = filter_var($_POST['contact_email'], FILTER_SANITIZE_EMAIL);
			$message = filter_var($_POST['contact_message'], FILTER_SANITIZE_STRING);
			$timestamp = date("F jS Y, h:iA.", time());

			if ($name === FALSE) {
				echo "Ógilt nafn";
				exit(1);
			}else if ($email === FALSE) {
			    echo "Ógilt tölvupóstfang";
			    exit(1);
			} else if ($message === FALSE) {
				echo "Ógild skilaboð";
				exit(1);
			} else {
				send_message($name, $mobile, $email, $message, $timestamp);
			}
		} ?>
</div> <!-- primary -->

<?php
get_footer();
?>