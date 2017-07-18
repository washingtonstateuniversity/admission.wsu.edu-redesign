<?php

if ( ! is_front_page() && ! is_home() && spine_display_breadcrumbs( 'bottom' ) ) {
	?><section class="row single breadcrumbs breadcrumbs-bottom gutter pad-top" typeof="BreadcrumbList" vocab="http://schema.org/">
	<div class="column one"><?php bcn_display(); ?></div>
	</section><?php
}

?>
<footer class="site-footer">
	<?php
	if ( has_nav_menu( 'footer' ) ) {
		$spine_site_args = array(
			'theme_location' => 'footer',
			'container' => false,
			'container_class' => false,
			'container_id' => false,
			'fallback_cb' => false,
			'menu_class' => null,
			'menu_id' => null,
			'items_wrap' => '<ul>%3$s</ul>',
			'depth' => 1,
		);

		wp_nav_menu( $spine_site_args );
	}
	?>
</footer>
