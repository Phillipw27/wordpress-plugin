<?php
/*
Template Name: Top Sub Menu
*/

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php $featured = do_shortcode('[pods field="featured_image"]'); ?>
			<?php if( $featured ): ?>
				<?php $align = do_shortcode('[pods field="featured_text_alignment"]'); ?>
				<div id="featured-image" class="<?php if ($align) { echo do_shortcode('[pods field="featured_text_alignment"]'); } else { echo 'right'; } ?>">
		    		<img src="<?php echo $featured; ?>" />
		    		<?php $featured_text = do_shortcode('[pods field="featured_image_text"]'); ?>
		    		<?php if ($featured_text): ?>
		    		<div id="featured-text-wrapper">
		    			<div class="featured-text"><?php echo $featured_text; ?></div>
		    		</div>
		    		<?php endif; ?>
			    </div>
			<?php endif; ?>			
			<div id="main-content">		
				<div id="top-fade"></div>		
				<div id="bottom-fade"></div>
				<?php
					$sub_menu = do_shortcode('[pods field="add_submenu"]');

					if ($sub_menu) {
						$defaults = array(
							'theme_location'  => '',
							'menu'            => $sub_menu,
							'container'       => 'div',
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => 'menu',
							'menu_id'         => '',
							'echo'            => true,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'           => 0,
							'walker'          => ''
						);
					}
				?>
				
				<?php if ($sub_menu): ?>
					<div class="mw" style="padding-top: 3px">
					<div class="submenu top-submenu"><?php echo wp_nav_menu( $defaults ); ?></div>
				<?php else: ?>
					<div class="mw">
				<?php endif; ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', 'page' ); ?>

						<?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || '0' != get_comments_number() ) :
								comments_template();
							endif;
						?>

					<?php endwhile; // end of the loop. ?>

					<?php get_sidebar(); ?>
				</div><!-- mw -->
			</div><!-- #main-content -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
