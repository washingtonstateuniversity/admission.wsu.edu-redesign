<?php

// Provide support for the /web-template/ JSON endpoint.
include_once( 'includes/wsuwp-json-web-template.php' );

// Include the information form shortcode.
include_once( 'includes/info-form.php' );

class WSU_Admission_Theme {
	/**
	 * @var string The version of the WSU Admission theme for cache breaking.
	 */
	public $version = '0.0.7';

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_filter( 'theme_page_templates', array( $this, 'prune_page_templates' ) );
		add_filter( 'wp_kses_allowed_html', array( $this, 'allow_download_attribute' ), 10 );
		add_filter( 'bu_navigation_filter_item_attrs', array( $this, 'bu_navigation_filter_item_atts' ), 10, 2 );
		add_action( 'wp_footer', array( $this, 'carnegie_tracking_tags' ), 101 );
		add_action( 'wp_footer', array( $this, 'chegg_conversion_pixels' ), 102 );
		add_filter( 'spine_main_header_elements', array( $this, 'admission_header_elements' ), 12 );
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
	 * Filter BU Navigation to add the `current` tag to a nav item that matches the requested
	 * URL when loading one of the admission sub-sites.
	 *
	 * @param array  $item_classes
	 * @param object $page
	 *
	 * @return array
	 */
	public function bu_navigation_filter_item_atts( $item_classes, $page ) {
		$page_url = wp_parse_url( $page->url );
		$page_path = '/';

		if ( ! empty( $page_url ) ) {
			$page_paths = explode( '/', $page_url['path'] );
			if ( ! empty( $page_paths[1] ) ) {
				$page_path = '/' . $page_paths[1] . '/';
			}
		}

		$request_paths = explode( '/', $_SERVER['REQUEST_URI'] );
		$request_path = false;

		if ( ! empty( $request_paths[1] ) ) {
			$request_path = '/' . $request_paths[1] . '/';
		}

		if ( in_array( $page_path, array( '/for-counselors/', '/for-parents/', '/for-advisors/' ), true ) && $request_path === $page_path ) {
			$item_classes[] = 'current';
		}

		return $item_classes;
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
	 * Retrieve the ID of the main site for admission.wsu.edu.
	 *
	 * @return int ID of the site.
	 */
	public static function get_main_site_id() {
		// The primary domain can be filtered for local development.
		$home_domain = apply_filters( 'admission_home_domain', 'admission.wsu.edu' );

		$site = get_blog_details( array(
			'domain' => $home_domain,
			'path' => '/',
		) );

		if ( $site ) {
			return $site->blog_id;
		}

		return get_current_blog_id();
	}

	/**
	 * Determine whether to show the shared, primary navigation from admission.wsu.edu.
	 *
	 * @return bool
	 */
	public static function show_main_navigation() {
		$site = get_blog_details();

		// The primary domain can be filtered for local development.
		$home_domain = apply_filters( 'admission_home_domain', 'admission.wsu.edu' );

		// Site paths that should show the primary navigation. This will include
		// page paths under these sites.
		$shared_nav_paths = array(
			'/',
			'/for-counselors/',
			'/for-parents/',
			'/for-advisors/',
		);

		// The shared nav paths can be filtered for local development.
		$shared_nav_paths = apply_filters( 'admission_shared_nav_paths', $shared_nav_paths );

		if ( $home_domain === $site->domain && in_array( $site->path, $shared_nav_paths, true ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Filters the Spine Header elements.
	 *
	 * @since 0.0.8
	 */
	public function admission_header_elements( $main_header_elements ) {
		if ( is_page() ) {
			$main_header_elements['sub_header_default'] = get_the_title();
			$page_tagline = get_post_meta( get_the_ID(), 'sub-header', true );
			$main_header_elements['page_tagline'] = ( $page_tagline ) ? $page_tagline : get_the_title();
		} elseif ( is_category() ) {
			$main_header_elements['sub_header_default'] = single_cat_title( '', false );
			$main_header_elements['page_tagline'] = 'Posts';
		} elseif ( is_single() ) {
			$category = get_the_category();
			$main_header_elements['sub_header_default'] = $category[0]->cat_name;
			$main_header_elements['page_tagline'] = 'Posts';
		}

		if ( ! isset( $main_header_elements['page_tagline'] ) ) {
			$main_header_elements['page_tagline'] = $main_header_elements['sub_header_default'];
		}

		return $main_header_elements;
	}
}

new WSU_Admission_Theme();
