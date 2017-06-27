<?php
/**
 * This file is used by the WSUWP JSON Web Template plugin to provide a portion
 * of the content output via JSON.
 */

$site_name = get_bloginfo( 'name' );
$site_tagline = get_bloginfo( 'description' );
$page_heading = get_post_meta( get_the_ID(), '_wsuwp_web_app_subhead', true );
$background_image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
?>
<main class="app-web-template">

<header class="main-header">
	<div class="header-group hgroup guttered padded-bottom short">
		<sup class="sup-header"><a href="<?php home_url(); ?>" title="<?php echo esc_attr( $site_name ); ?>" rel="home"><?php echo esc_attr( $site_name ); ?></a></sup>
		<sub class="sub-header"><span class="sub-header-default"><?php echo get_the_title(); ?></span></sub>
	</div>
</header>

<section class="row single">

	<div class="column one">

		<div class="globalbar"></div>

		<div class="pillar">
			<a href="https://admission.wsu.edu/"></a>
		</div>

		<div class="hashtag">
			<a href="https://tagboard.com/futurecougs/search">#FutureCougs</a>
		</div>

	</div>

</section>

<div class="section-wrapper section-wrapper-has-background header-background"<?php if ( $background_image ) { ?> data-background="<?php echo esc_url( $background_image ); ?>" data-background-mobile="<?php echo esc_url( $background_image ); ?>"<?php } ?>>

	<section class="row single gutter pad-top pad-bottom featured md heromask-gradient">

		<div class="column one">

			<div class="flexwrap">
				<h1><?php echo esc_html( $page_heading ); ?></h1>
			</div>

		</div>

	</section>

</div>
