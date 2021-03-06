<?php
/**
 * Shortcode Generator
 */
class Smpl_Shortcode_Generator {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Add TinMCE generator button
		add_action( 'admin_init', array( $this, 'add_mce_button' ) );

		// Only use wp_ajax if user is logged in
		add_action( 'wp_ajax_smpl_check_url_action', array( $this, 'ajax_action_check_url' ) );
		// @todo - In the future, create new generator that gets used under
		// HTML Tab only for the pros that hate WYSIWYG!
		// add_action('admin_print_footer_scripts', array( $this, 'add_toolbar_button' ), 100 );
	}

	/**
	 * Add toolbar button.
	 *
	 * @todo
	 */
	public function add_toolbar_button(){
		?>
		<script type="text/javascript">
	    jQuery(function($){
	    	$('#ed_toolbar').append('<a class="">BUTTON FOR HTML TAB</a>');
		});
		</script>
		<?php
	}

	/**
	 * Add shortcode generator button.
	 *
	 * @since 1.0.0
	 */
	public function add_mce_button() {
		if ( ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) && get_user_option('rich_editing') == 'true' ) {
		  	// TinyMCE plugin stuff
			add_filter( 'mce_buttons', array( $this, 'filter_mce_buttons' ) );
			add_filter( 'mce_external_plugins', array( $this, 'filter_mce_external_plugins' ) );
			// TinyMCE shortcode plugin CSS
			wp_enqueue_style( 'smpl-tinymce-shortcodes', SMPL_SHORTCODES_PLUGIN_URI . '/includes/admin/generator/assets/css/shortcodes.css', null, SMPL_SHORTCODES_PLUGIN_VERSION );
		}
	}

	/**
	 * Filter TinyMCE buttons.
	 *
	 * @since 1.0.0
	 */
	function filter_mce_buttons( $buttons ) {
		array_push( $buttons, 'smpl_shortcodes_button' );
		return $buttons;
	}

	/**
	 * Actually add tinyMCE plugin attachment.
	 *
	 * @since 1.0.0
	 */
	function filter_mce_external_plugins( $plugins ) {
		global $wp_version;
		if ($wp_version >= 3.9) {
    	    $plugins['SmplShortcodes'] = SMPL_SHORTCODES_PLUGIN_URI . '/includes/admin/generator/editor_plugin_mce_v4.js';
		} else {
    	    $plugins['SmplShortcodes'] = SMPL_SHORTCODES_PLUGIN_URI . '/includes/admin/generator/editor_plugin_mce_v3.js';
		}
        return $plugins;
	}

	/**
	 * Ajax Check.
	 *
	 * @since 1.0.0
	 */
	public function ajax_action_check_url() {
		$hadError = true;
		$url = isset( $_REQUEST['url'] ) ? $_REQUEST['url'] : '';
		if ( strlen( $url ) > 0  && function_exists( 'get_headers' ) ) {
			$file_headers = @get_headers( $url );
			$exists       = $file_headers && $file_headers[0] != 'HTTP/1.1 404 Not Found';
			$hadError     = false;
		}
		echo '{ "exists": '. ($exists ? '1' : '0') . ($hadError ? ', "error" : 1 ' : '') . ' }';
		die();
	}

}