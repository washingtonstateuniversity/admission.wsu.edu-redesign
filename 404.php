<?php get_header(); ?>

	<main id="wsuwp-main" class="spine-single-template">

		<?php get_template_part( 'parts/headers' ); ?>

		<section class="row side-right gutter pad-top">

			<div class="column one">

				<article class="post error404 no-results not-found">

					<div class="entry-content">

						<div class="rule crm"></div>

						<p class="intro">It seems we can't find what you're looking for. Perhaps searching can help.</p>

						<?php get_search_form(); ?>

					</div><!-- .entry-content -->

				</article>

			</div><!--/column-->

			<div class="column two"></div>

		</section>

		<?php get_template_part( 'parts/footers' ); ?>

	</main>

<?php
get_footer();
