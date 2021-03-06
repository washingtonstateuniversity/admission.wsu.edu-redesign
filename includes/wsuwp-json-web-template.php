<?php

class WSUWP_New_JSON_Web_Template {
	private static $instance;

	/**
	 * @var string The slug used for the content type.
	 */
	public $content_type = 'json_web_template';

	/**
	 * @var string The key used to store a template's URL in meta.
	 */
	public $url_meta_key = '_wsuwp_web_app_url';

	/**
	 * @var string The key used to store a template's subheading in meta.
	 */
	public $subhead_meta_key = '_wsuwp_web_app_subhead';

	/**
	 * @var string Tracks the application URL assigned to an individual template.
	 */
	public $application_url = '';

	/**
	 * Add hooks.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_content_type' ) );
		add_action( 'template_redirect', array( $this, 'template_takeover' ), 10 );
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_post' ), 10, 2 );
		add_filter( 'nav_menu_css_class', array( $this, 'set_current_menu_class' ), 50, 3 );
		add_filter( 'bu_navigation_filter_item_attrs', array( $this, 'bu_navigation_filter_item_attrs' ), 10, 2 );
	}

	/**
	 * Register a content type to track web templates used for a specific site and theme.
	 */
	public function register_content_type() {
		$args = array(
			'labels' => array(
				'name' => 'Web Templates',
				'singular_name' => 'Web Template',
				'add_new_item' => 'Add New Web Template',
				'add_new' => 'Add New',
			),
			'description' => 'Web templates used by external applications.',
			'public' => true,
			'hierarchical' => false,
			'menu_position' => 10,
			'menu_icon' => 'dashicons-slides',
			'supports' => array(
				'title',
				'revisions',
				'thumbnail',
			),
			'taxonomies' => array(),
			'has_archive' => false,
			'rewrite' => array(
				'slug' => 'web-template',
				'with_front' => false,
			),
		);

		register_post_type( $this->content_type, $args );
	}

	/**
	 * Configure the meta boxes to display for capturing the current page URL.
	 *
	 * @param string $post_type The current post's post type.
	 */
	public function add_meta_boxes( $post_type ) {
		if ( $this->content_type === $post_type ) {
			add_meta_box( 'wsu_application_url', 'Configuration', array( $this, 'display_application_url_meta_box' ), null, 'normal', 'default' );
		}
	}

	/**
	 * Display a meta box to capture the current menu item's URL when processing a web template.
	 *
	 * @param WP_Post $post Current post object being edited.
	 */
	public function display_application_url_meta_box( $post ) {
		wp_nonce_field( 'application-url', '_save_url' );

		$url = get_post_meta( $post->ID, $this->url_meta_key, true );
		$subhead = get_post_meta( $post->ID, $this->subhead_meta_key, true );

		?>
		<label for="application_url">Application URL</label>
		<input id="application_url" class="widefat" name="application_url" type="text" value="<?php echo esc_url( $url ); ?>" />
		<p class="description">This should match the HREF element of a menu item in the primary navigation for this site. This item will be marked as current when viewing the template via another application.</p>

		<label for="application_subhead">Subheading</label>
		<input id="application_subhead" class="widefat" name="application_subhead" type="text" value="<?php echo esc_attr( $subhead ); ?>" />
		<p class="description">The subheading to display in the page's header when viewing the template via another application.</p>
		<?php
	}

	/**
	 * Save meta data attached to a web template.
	 *
	 * @param int     $post_id ID of the post being saved.
	 * @param WP_Post $post    Post object being saved.
	 */
	public function save_post( $post_id, $post ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( $this->content_type !== $post->post_type || 'auto-draft' === $post->post_status ) {
			return;
		}

		if ( ! isset( $_POST['application_url'] ) ) {
			return;
		}

		wp_verify_nonce( $_POST['_save_url'], 'application-url' );

		update_post_meta( $post_id, $this->url_meta_key, sanitize_text_field( $_POST['application_url'] ) );
		update_post_meta( $post_id, $this->subhead_meta_key, sanitize_text_field( $_POST['application_subhead'] ) );
	}

	/**
	 * Look for and handle any requests made to the `/web-template/` URL so that a JSON object containing
	 * the two parts of the template can be returned. We force the response to 200 OK and die as soon as
	 * the JSON is output.
	 */
	public function template_takeover() {
		if ( ! is_singular( $this->content_type ) ) {
			return;
		}

		$this->application_url = get_post_meta( get_the_ID(), $this->url_meta_key, true );

		$post = get_post();

		$pre = $this->build_pre_content();
		$post = $this->build_post_content();

		header( 'HTTP/1.1 200 OK' );
		header( 'Content-Type: application/json' );
		echo wp_json_encode( array(
			'before_content' => $pre,
			'after_content' => $post,
		) );
		die( 0 );
	}

	/**
	 * Build the HTML to be displayed before any additional content is added by the requesting page.
	 *
	 * @return string HTML content.
	 */
	private function build_pre_content() {
		ob_start();

		get_header();

		?>
		<main class="app-web-template">
		<?php

		get_template_part( 'parts/headers' );

		$content = ob_get_clean();

		return $content;
	}

	/**
	 * Build the HTML to be displayed after any additional content is added by the requesting page.
	 *
	 * @return string HTML content.
	 */
	private function build_post_content() {
		ob_start();

		get_template_part( 'parts/footers' );

		?>
		</main>
		<?php

		get_footer();

		$content = ob_get_clean();

		return $content;
	}

	/**
	 * Filter list item classes to add active when default nav menus are in use.
	 *
	 * @param array    $classes
	 * @param WP_Post  $item
	 * @param stdClass $args
	 *
	 * @return array
	 */
	public function set_current_menu_class( $classes, $item, $args ) {
		if ( is_singular( $this->content_type ) && 'site' === $args->menu && $this->application_url === $item->url ) {
			$classes[] = 'active';
		}

		return $classes;
	}

	/**
	 * Filter the list item classes to manually add active when necessary.
	 *
	 * @param array   $item_classes List of classes assigned to the list item.
	 * @param WP_Post $page         Post object for the current page.
	 *
	 * @return array
	 */
	public function bu_navigation_filter_item_attrs( $item_classes, $page ) {
		if ( is_singular( $this->content_type ) && $this->application_url === $page->url ) {
			$item_classes[] = 'active';
		}

		return $item_classes;
	}
}
new WSUWP_New_JSON_Web_Template();
