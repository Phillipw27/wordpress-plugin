<?php
/**
 * The Template for displaying all single posts.
 *
 * @package westminster_academy
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div id="main-content">
			<div class="mw">
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'single' ); ?>

					<?php westminster_academy_post_nav(); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() ) :
							comments_template();
						endif;
					?>

				<?php endwhile; // end of the loop. ?>
				<?php get_sidebar(); ?>
				</div><!-- .mw -->
			</div><!-- #main-content -->
		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>