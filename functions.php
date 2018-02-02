<?php

// Provide support for the /web-template/ JSON endpoint.
include_once( 'includes/wsuwp-json-web-template.php' );

// Include the information form shortcode.
include_once( 'includes/info-form.php' );

// Include additional customizer options.
include_once( 'includes/extended-customizer.php' );

class WSU_Admission_Theme {
	/**
	 * @var string The version of the WSU Admission theme for cache breaking.
	 */
	public $version = '0.0.15';

	/**
	 * Start things up.
	 */
	public function __construct() {
		add_filter( 'spine_child_theme_version', array( $this, 'theme_version' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_web_template_scripts' ), 99 );
		add_filter( 'theme_page_templates', array( $this, 'prune_page_templates' ) );
		add_filter( 'wp_kses_allowed_html', array( $this, 'allow_download_attribute' ), 10 );
		add_action( 'wp_footer', array( $this, 'carnegie_tracking_tags' ), 101 );
		add_action( 'wp_footer', array( $this, 'chegg_conversion_pixels' ), 102 );
		add_filter( 'spine_main_header_elements', array( $this, 'admission_header_elements' ), 12 );
		add_filter( 'bu_navigation_filter_item_attrs', array( $this, 'bu_navigation_filter_item_attrs' ), 10, 2 );
		add_action( 'init', array( $this, 'register_footer_menu' ) );
		add_filter( 'nav_menu_css_class', array( $this, 'footer_menu_classes' ), 10, 3 );
		add_filter( 'nav_menu_item_id', array( $this, 'footer_menu_item_ids' ), 10, 3 );
	}

	/**
	 * Provide a theme version for use in cache busting.
	 *
	 * @since 0.0.11
	 *
	 * @return string
	 */
	public function theme_version() {
		return $this->version;
	}

	/**
	 * Enqueue scripts.
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'feature-parallax', get_stylesheet_directory_uri() . '/js/feature-parallax.min.js', array( 'jquery' ), $this->version, true );

		wp_enqueue_script( 'calculators', get_stylesheet_directory_uri() . '/js/calculators.min.js', array( 'jquery' ), $this->version, true );

		wp_enqueue_script( 'back-to-top', get_stylesheet_directory_uri() . '/js/back-to-top.min.js', array( 'jquery' ), $this->version, true );

		if ( ! wp_is_mobile() ) {
			wp_enqueue_script( 'link-ripple', get_stylesheet_directory_uri() . '/js/link-ripple.min.js', array( 'jquery' ), $this->version, true );
		}

		if ( is_front_page() ) {
			wp_enqueue_script( 'home', get_stylesheet_directory_uri() . '/js/home.min.js', array( 'jquery' ), $this->version, true );
		}
	}

	/**
	 * Enqueue scripts specific to the web templates.
	 */
	public function enqueue_web_template_scripts() {
		if ( is_singular( 'json_web_template' ) && is_single( 'campus-tours' ) ) {
			wp_enqueue_style( 'campus-tours', 'https://admission.wsu.edu/visits/individual/css/individual.css', null, null );
		}
	}

	public function prune_page_templates( $templates ) {
		unset( $templates['templates/halves.php'] );
		unset( $templates['templates/margin-left.php'] );
		unset( $templates['templates/margin-right.php'] );
		unset( $templates['templates/side-left.php'] );
		unset( $templates['templates/side-right.php'] );
		unset( $templates['templates/single.php'] );
		return $templates;
	}

	/**
	 * Allow the download attribute to be used inside an anchor. This is supported in modern browsers
	 * and allows a content publisher to tag a link to be downloaded rather than followed.
	 *
	 * @param array $tags List of elements and attributes allowed.
	 *
	 * @return mixed Modified list of elements and attributes.
	 */
	public function allow_download_attribute( $tags ) {
		$tags['a']['download'] = true;

		return $tags;
	}

	/**
	 * Insert tracking tags used for retargeting with Carnegie Communications
	 */
	public function carnegie_tracking_tags() {
		?>
		<!-- Google Code for Remarketing Tag -->
		<!--------------------------------------------------
		Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
		--------------------------------------------------->
		<script type="text/javascript">
			/* <![CDATA[ */
			var google_conversion_id = 864713563;
			var google_custom_params = window.google_tag_params;
			var google_remarketing_only = true;
			/* ]]> */
		</script>
		<script type="text/javascript" src="https://www.googleadservices.com/pagead/conversion.js">
		</script>
		<noscript>
			<div style="display:inline;">
				<img height="1" width="1" style="border-style:none;" alt="" src="https://googleads.g.doubleclick.net/pagead/viewthroughconversion/864713563/?guid=ON&amp;script=0"/>
			</div>
		</noscript>
		<!-- Facebook Pixel Code -->
		<script>
			!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
				n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
				n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
				t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
				document,'script','https://connect.facebook.net/en_US/fbevents.js');
			fbq('init', '1283395071698859'); // Insert your pixel ID here.
			fbq('track', 'PageView');
		</script>
		<noscript><img height="1" width="1" style="display:none"
					   src="https://www.facebook.com/tr?id=1283395071698859&ev=PageView&noscript=1"
			/></noscript>
		<!-- DO NOT MODIFY -->
		<!-- End Facebook Pixel Code -->
		<?php
	}

	/**
	 * Displays various conversion pixels (via Chegg) on the appropriate pages.
	 *
	 * @since 1.3.11
	 */
	public function chegg_conversion_pixels() {
		$site = get_site();

		// Conversion pixels only show on the main admission site.
		if ( 'admission.wsu.edu' !== $site->domain || '/' !== $site->path ) {
			return;
		}

		$request_uri = explode( '?', $_SERVER['REQUEST_URI'] );

		if ( '/' === $request_uri[0] ) {
			?>
			<!-- Washington State University JavaScript Conversion; Goal ID: 'admissions' -->
			<script type="text/javascript">var ordnumber = Math.random() * 10000000000000;var sscUrl = ("https:" == document.location.protocol ? "https://" : "http://") + "trkn.us/pixel/c?ppt=719&g=admissions&gid=3689&ord="+ordnumber+"&v=114";var x = document.createElement("IMG");x.setAttribute("src", sscUrl);x.setAttribute("width", "1");x.setAttribute("height", "1");document.body.appendChild(x);</script>
			<?php
		}

		if ( '/visits/' === $request_uri[0] ) {
			?>
			<!-- Washington State University JavaScript Conversion; Goal ID: 'visit' -->
			<script type="text/javascript">var ordnumber = Math.random() * 10000000000000;var sscUrl = ("https:" == document.location.protocol ? "https://" : "http://") + "trkn.us/pixel/c?ppt=719&g=visitslong&gid=3849&ord="+ordnumber+"&v=115";var x = document.createElement("IMG");x.setAttribute("src", sscUrl);x.setAttribute("width", "1");x.setAttribute("height", "1");document.body.appendChild(x);</script>
			<?php
		}

		if ( '/apply/as/freshmen/requirements/' === $request_uri[0] ) {
			?>
			<!-- Washington State University JavaScript Conversion; Goal ID: 'requirements' -->
			<script type="text/javascript">var ordnumber = Math.random() * 10000000000000;var sscUrl = ("https:" == document.location.protocol ? "https://" : "http://") + "trkn.us/pixel/c?ppt=719&g=requirementslong&gid=3848&ord="+ordnumber+"&v=115";var x = document.createElement("IMG");x.setAttribute("src", sscUrl);x.setAttribute("width", "1");x.setAttribute("height", "1");document.body.appendChild(x);</script>
			<?php
		}
	}

	/**
	 * Filters the Spine Header elements.
	 *
	 * @since 0.0.8
	 */
	public function admission_header_elements( $main_header_elements ) {
		$main_header_elements['hashtag'] = spine_get_option( 'global_main_header_hashtag' );
		$main_header_elements['hashtag_url'] = spine_get_option( 'global_main_header_hashtag_url' );
		$blog_tagline = 'Newsletters';

		if ( is_page() ) {
			$main_header_elements['sub_header_default'] = get_the_title();
			$page_tagline = get_post_meta( get_the_ID(), 'sub-header', true );
			$main_header_elements['page_tagline'] = ( $page_tagline ) ? $page_tagline : get_the_title();
		} elseif ( is_archive() && ! is_post_type_archive() ) {
			$main_header_elements['page_tagline'] = $blog_tagline;
		} elseif ( is_category() ) {
			$main_header_elements['sub_header_default'] = single_cat_title( '', false );
			$main_header_elements['page_tagline'] = $blog_tagline;
		} elseif ( is_singular( 'post' ) ) {
			$category = get_the_category();
			$main_header_elements['sub_header_default'] = $category[0]->cat_name;
			$main_header_elements['page_tagline'] = $blog_tagline;
		} elseif ( is_404() ) {
			$main_header_elements['sub_header_default'] = '404';
			$main_header_elements['page_tagline'] = 'Page Not Found';
		} elseif ( is_singular( 'json_web_template' ) ) {
			$main_header_elements['page_tagline'] = get_post_meta( get_the_ID(), '_wsuwp_web_app_subhead', true );
		}

		if ( ! isset( $main_header_elements['page_tagline'] ) ) {
			$main_header_elements['page_tagline'] = $main_header_elements['sub_header_default'];
		}

		return $main_header_elements;
	}

	/**
	 * Filter the list item classes to manually add active on the current page in nav.
	 *
	 * @since 0.0.10
	 *
	 * @param array   $item_classes List of classes assigned to the list item.
	 * @param WP_Post $page         Post object for the current page.
	 *
	 * @return array
	 */
	public function bu_navigation_filter_item_attrs( $item_classes, $page ) {
		if ( is_category() ) {
			$category = get_category( get_query_var( 'cat' ) );
			$category_url = get_category_link( $category->cat_ID );

			if ( isset( $page->url ) && trailingslashit( $page->url ) === $category_url ) {
				$item_classes[] = 'active';
			}
		}

		if ( is_singular( 'post' ) ) {
			$category = get_the_category();
			$category_url = get_category_link( $category[0]->cat_ID );

			if ( isset( $page->url ) && trailingslashit( $page->url ) === $category_url ) {
				$item_classes[] = 'active';
			}
		}

		return $item_classes;
	}

	/**
	 * Registers the menu locations for the site footer.
	 *
	 * @since 0.0.10
	 */
	public function register_footer_menu() {
		register_nav_menu( 'footer-desktop', 'Footer (desktop)' );
		register_nav_menu( 'footer-mobile', 'Footer (mobile)' );
	}

	/**
	 * Removes the default menu item classes and adds "ripple" for the footer menus.
	 *
	 *
	 * @param array    $classes Current list of nav menu classes.
	 * @param WP_Post  $item    Post object representing the menu item.
	 * @param stdClass $args    Arguments used to create the menu.
	 *
	 * @return array Modified list of nav menu classes.
	 */
	public function footer_menu_classes( $classes, $item, $args ) {
		if ( 'footer-desktop' === $args->menu->slug || 'footer-mobile' === $args->menu->slug ) {
			$classes = array( 'ripple' );
		}

		return $classes;
	}

	/**
	 * Removes the ids from the footer menu items.
	 *
	 *
	 * @param string   $menu_id The ID that is applied to the menu item's <li> element.
	 * @param WP_Post  $item    Post object representing the menu item.
	 * @param stdClass $args    Arguments used to create the menu.
	 *
	 * @return string|bool
	 */
	public function footer_menu_item_ids( $menu_id, $item, $args ) {
		if ( 'footer-desktop' === $args->menu->slug || 'footer-mobile' === $args->menu->slug ) {
			return false;
		}

		return $menu_id;
	}
}

new WSU_Admission_Theme();
