<?php get_header(); ?>

<main id="wsuwp-main">

	<?php get_template_part( 'parts/headers' ); ?>

	<?php get_template_part( 'parts/single-layout', get_post_type() ); ?>

	<footer class="main-footer">
		<section class="row halves pager prevnext gutter pad-ends">
			<div class="column one">
				<?php previous_post_link(); ?>
			</div>
			<div class="column two">
				<?php next_post_link(); ?>
			</div>
		</section><!--pager-->
	</footer>

	<?php get_template_part( 'parts/footers' ); ?>

</main><!--/#page-->

<?php
get_footer();
