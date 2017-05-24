<?php
/**
 * valkostur functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package valkostur
 */

if ( ! function_exists( 'valkostur_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function valkostur_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on valkostur, use a find and replace
	 * to change 'valkostur' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'valkostur', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'valkostur' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'valkostur_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'valkostur_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function valkostur_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'valkostur_content_width', 640 );
}
add_action( 'after_setup_theme', 'valkostur_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function valkostur_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'valkostur' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'valkostur' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name' => 'Footer Sidebar 1',
		'id' => 'footer-sidebar-1',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => 'Footer Sidebar 2',
		'id' => 'footer-sidebar-2',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => 'Instagram-pics',
		'id' => 'insta-pics',
		'description' => 'Appears on page - Myndasafn ',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'valkostur_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function valkostur_scripts() {
	wp_enqueue_style( 'valkostur-style', get_stylesheet_uri() );

	wp_enqueue_script( 'valkostur-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'valkostur-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'valkostur_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



/**
/* Returns one paragraph from page
*/
function para_excerpt($text, $raw_excerpt) {
    if( ! $raw_excerpt ) {
        $content = apply_filters( 'the_content', get_the_content() );
        $text = substr( $content, 0, strpos( $content, '</p>' ) + 4 );
    }
    $text = preg_replace("/<img[^>]+\>/i", "", $text); 
    return $text;
}
add_filter( 'wp_trim_excerpt', 'para_excerpt', 10, 2 );

/**
/* Get image by name from WordPress Media
/* http://stackoverflow.com/questions/20470853/get-the-url-file-by-name-of-image 
**/
function get_attachment_url_by_slug( $slug ) {
  $args = array(
    'post_type' => 'attachment',
    'name' => sanitize_title($slug),
    'posts_per_page' => 1,
    'post_status' => 'inherit',
  );
  $_header = get_posts( $args );
  $header = $_header ? array_pop($_header) : null;
  return $header ? wp_get_attachment_url($header->ID) : '';
}

/**
/* Add data from user to database
*/
function add_data( $type, $subtype, $name ,$description, $price) {
	global $wpdb;
	$servername = "localhost";
	$username = "valkostur";
	$password = "einsikokkur";
	$dbname = "valkostur";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$typeEs = mysqli_real_escape_string($conn, $type);
	$subtypeEs = mysqli_real_escape_string($conn, $subtype);
	$nameEs = mysqli_real_escape_string($conn, $name);
	$descriptionEs = mysqli_real_escape_string($conn, $description);
	$priceEs = mysqli_real_escape_string($conn, $price);
	$dataID = $wpdb->get_results("SELECT id FROM veislur");

	// Find the heighest id
	$ids = array();
	foreach ($dataID as $value) {
		array_push($ids, $value->id);
	}
	$id = max($ids)+1;

	// prepare and bind
	$sql = "INSERT INTO veislur (type, subtype, name, description, price, id) VALUES (?,?,?,?,?,?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('ssssss', $typeEs, $subtypeEs, $nameEs, $descriptionEs, $priceEs, $id);

	if ($stmt->execute() === TRUE) {
	    echo "Réttinum hefur verið bætt við!";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close(); // Close the database connection
}

/**
/* Remove data from the database
*/
function remove_data( $id ) {
	$servername = "localhost";
	$username = "valkostur";
	$password = "einsikokkur";
	$dbname = "valkostur";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "DELETE FROM veislur WHERE id=$id";

	if ($conn->query($sql) === TRUE) {
	    echo "Rétti hefur verið eytt!";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close(); // Close the database connection
}

/**
/* Display table for menu types
*/
function create_menu_table( $type, $subtype, $data ) {

	$user_logged_in = is_user_logged_in();

	// Change $priceStr depending on which page
	if($type == 'sushi' || 'veisluhladbord'){
		$priceStr = ' kr/stk';
	} else {
		$priceStr = ' kr/mann';
	}

	// Display all appropriate data
	foreach ($data as $value) { 
		$description = str_replace('\r\n','<br>', utf8_decode($value->description));
		$name = str_replace('\r\n', '<br>', utf8_decode($value->name));
		$price = $value->price;
		$delete_button = "delete_button_" . $value->id;

		if($value->type==$type && $value->subtype == $subtype) { ?>
			<tr>
				<td class="table-header"> <?php echo $name ?> </td>
				<td class="table-price"> <?php echo $price . $priceStr; ?> </td>	
			</tr>	
			<tr>
				<td class="table-description"> <?php echo $description; ?> </td>
				<?php
				// If user is logged in, display delete button
				if($user_logged_in) { ?>
				<td>	
					<form method="POST" action='' class="delete_button">
						<input type="submit" name="<?php echo $delete_button?>" value="Eyða">
					</form>
					<?php
					// If delete button is pussed, delete item from database
					if (isset($_POST[$delete_button])) { 
   						remove_data($value->id); 
					} ?> 
				</td>
				<?php
				} ?>
			</tr>
			<tr>
				<td></br></br></td>
			</tr>
<?php 	
		}
	} 
}

/**
/* Send message from "Hafa samband" form
*/
function send_message($name, $mobile, $email, $message, $timestamp) {
	/* Configuration */
	$subject = 'Valkostur'; 
	$mailto  = 'einara89@gmail.com'; 
	/* END Configuration */

	$name = utf8_decode($name);
	$message = utf8_decode($message);
	
	$body = "
	<p><b>Nafn</b>: $name <br>
	<b>" . utf8_decode("Símanúmer</b>: ") . "$mobile <br>
	<b>" . utf8_decode("Tölvupóstur</b>: ") . "$email<br>
	<p>" . utf8_decode("Skilaboð voru send <b>") . "$timestamp</b></p>
	<br>
	" . utf8_decode("<p>Skilaboð:</p>") . "$message <br>
	";

	// Success Message
	$success = "
	<div class=\"row\">
	    <div class=\"thankyou\">
	        <h3>Skilaboðin hafa verið send!</h3>
	    </div>
	</div>
	";

	$headers = "From: $name <$email> \r\n";
	$headers .= "Reply-To: $email \r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$message = "<html><body>$body</body></html>";

	if (mail($mailto, $subject, $message, $headers)) {
	    echo "$success"; // success
	} else {
	    echo 'Villa kom upp! Vinsamlegast reyndu aftur!'; // failure
	}
}