<?php

/**
 * Retrieve an array of values to be used in the header.
 *
 * site_name
 * site_tagline
 * page_title
 * post_title
 * section_title
 * subsection_title
 * posts_page_title
 * sup_header_default
 * sub_header_default
 * sup_header_alternate
 * sub_header_alternate
 * page_tagline (added by this child theme)
 */
$spine_main_header_values = spine_get_main_header();

if ( true === spine_get_option( 'main_header_show' ) ) :

?>
<header class="main-header section-wrapper-has-background"<?php if ( spine_has_featured_image() ) { ?> style="background-image: url('<?php echo esc_url( spine_get_featured_image_src() ); ?>');"<?php } ?>>

	<a class="pillar ripple" href="<?php home_url(); ?>"></a>

	<a class="hashtag ripple" href="https://tagboard.com/futurecougs/search">#FutureCoug</a>

	<div class="header-group hgroup">

		<sup class="sup-header">
			<span class="sup-header-default"><?php echo wp_kses_post( strip_tags( $spine_main_header_values['sup_header_default'], '<a>' ) ); ?></span>
			</sup>
		<sub class="sub-header">
			<span class="sub-header-default"><?php echo wp_kses_post( strip_tags( $spine_main_header_values['sub_header_default'], '<a>' ) ); ?></span>
		</sub>

	</div>

	<div class="header-bottom featured">
		<h1><?php echo esc_html( $spine_main_header_values['page_tagline'] ); ?></h1>
	</div>

</header>

<?php
endif;

if ( ! is_front_page() && ! is_home() && spine_display_breadcrumbs( 'top' ) ) {
	?><section class="row single breadcrumbs breadcrumbs-top gutter pad-top" typeof="BreadcrumbList" vocab="http://schema.org/">
		<div class="column one"><?php bcn_display(); ?></div>
	</section><?php
}

if ( is_front_page() && ! is_home() && true === spine_get_option( 'front_page_title' ) ) :
?>
<section class="row single gutter pad-ends">
	<div class="column one">
		<h1><?php the_title(); ?></h1>
	</div>
</section>
<?php
endif;

if ( is_home() && ! is_front_page() && true === spine_get_option( 'page_for_posts_title' ) ) :
	$page_for_posts_id = get_option( 'page_for_posts' );
	if ( $page_for_posts_id ) {
		$page_for_posts_title = get_the_title( $page_for_posts_id );
	} else {
		$page_for_posts_title = '';
	}
	?>
<section class="row single gutter pad-ends">
	<div class="column one">
		<h1><?php echo esc_html( $page_for_posts_title ); ?></h1>
	</div>
</section>
<?php
endif;
