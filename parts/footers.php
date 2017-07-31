<?php

if ( ! is_front_page() && ! is_home() && spine_display_breadcrumbs( 'bottom' ) ) {
	?>
	<section class="row single breadcrumbs breadcrumbs-bottom gutter pad-top" typeof="BreadcrumbList" vocab="http://schema.org/">
		<div class="column one"><?php bcn_display(); ?></div>
	</section>
	<?php
}

?>
<footer class="site-footer">
	<?php
	$footer_menu_args = array(
		'container' => false,
		'container_class' => false,
		'container_id' => false,
		'fallback_cb' => false,
		'menu_id' => null,
		'items_wrap' => '<ul class="%2$s">%3$s</ul>',
		'depth' => 1,
	);

	// Desktop footer menu.
	if ( has_nav_menu( 'footer-desktop' ) ) {
		$footer_menu_args['theme_location'] = 'footer-desktop';
		$footer_menu_args['menu_class'] = 'desktop';

		wp_nav_menu( $footer_menu_args );
	}

	// Mobile footer menu.
	if ( has_nav_menu( 'footer-mobile' ) ) {
		$footer_menu_args['theme_location'] = 'footer-mobile';
		$footer_menu_args['menu_class'] = 'mobile';

		wp_nav_menu( $footer_menu_args );
	}
	?>

	<ul class="social-media">
		<?php foreach ( spine_social_options() as $channel => $channel_url ) { ?>
		<li>
			<a class="ripple <?php echo esc_attr( $channel ); ?>" href="<?php echo esc_url( $channel_url ); ?>"><?php echo esc_html( ucfirst( $channel ) ); ?></a>
		</li>
		<?php } ?>
		<li>
			<a class="ripple back-to-top" href="#">Back to top</a>
		</li>
	</ul>

</footer>
