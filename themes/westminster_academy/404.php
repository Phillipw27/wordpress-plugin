<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package westminster_academy
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div id="main-content">		
				<div id="top-fade"></div>		
				<div id="bottom-fade"></div>
				<div class="mw">		

					<section class="error-404 not-found">
						<header class="page-header">
							<h1 class="page-title"><?php _e( '<div class="big">404 error</div>Oops! That page can&rsquo;t be found.', 'westminster_academy' ); ?></h1>
						</header><!-- .page-header -->

						<div class="page-content">
							<p><?php _e( 'It looks like nothing was found at this location. Head back <a href="/">Home</a> or use the search at the bottom of the page.', 'westminster_academy' ); ?></p>

							<?php //get_search_form(); ?>

							<?php //the_widget( 'WP_Widget_Recent_Posts' ); ?>

							<?php //if ( westminster_academy_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
			<!-- 				<div class="widget widget_categories">
								<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'westminster_academy' ); ?></h2>
								<ul> -->
								<?php
									// wp_list_categories( array(
									// 	'orderby'    => 'count',
									// 	'order'      => 'DESC',
									// 	'show_count' => 1,
									// 	'title_li'   => '',
									// 	'number'     => 10,
									// ) );
								?>
							<!-- 	</ul>
							</div> --><!-- .widget -->
							<?php //endif; ?>

							<?php
							/* translators: %1$s: smiley */
							//$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'westminster_academy' ), convert_smilies( ':)' ) ) . '</p>';
							//the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
							?>

							<?php //the_widget( 'WP_Widget_Tag_Cloud' ); ?>

						</div><!-- .page-content -->
					</section><!-- .error-404 -->
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>