<?php
/**
 * This file is used by the WSUWP JSON Web Template plugin to provide a portion
 * of the content output via JSON.
 */

$spine_main_header_values = spine_get_main_header();
$background_image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
$page_heading = get_post_meta( get_the_ID(), '_wsuwp_web_app_subhead', true );

?>
<main class="app-web-template">

<header class="main-header section-wrapper-has-background"<?php if ( $background_image ) { ?>
		style="background-image: url('<?php echo esc_url( $background_image ); ?>');"<?php } ?>>

	<a class="pillar ripple" href="<?php home_url(); ?>"></a>

	<a class="hashtag ripple" href="https://tagboard.com/futurecougs/search">#FutureCoug</a>

	<div class="header-group hgroup">

		<sup class="sup-header">
			<span class="sup-header-default"><?php echo wp_kses_post( strip_tags( $spine_main_header_values['sup_header_default'], '<a>' ) ); ?></span>
			</sup>
		<sub class="sub-header">
			<span class="sub-header-default"><?php echo get_the_title(); ?></span>
		</sub>

	</div>

	<div class="header-bottom featured">
		<h1><?php echo esc_html( $page_heading ); ?></h1>
	</div>

</header>
