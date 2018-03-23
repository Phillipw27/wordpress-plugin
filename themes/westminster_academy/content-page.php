<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package westminster_academy
 */
?>

<!-- INTRODUCTION -->
<?php $intro = do_shortcode('[pods field="introduction"]'); ?>
<?php if ($intro): ?>
<!-- <header class="entry-header">
	<h1 class="entry-title"><?php the_title(); ?></h1>
</header> --><!-- .entry-header -->	
<div id="introduction">
	<?php echo $intro; ?>
</div>
<?php endif; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if (!$intro): ?>
<!-- 	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header> --><!-- .entry-header -->
	<?php endif; ?>
	<?php if (is_page_template('submenu-page.php')): ?>
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
			<div class="submenu"><?php echo wp_nav_menu( $defaults ); ?></div>
		<?php endif; ?>
	<?php endif; ?>

	<div class="entry-content">
	<?php if (is_page_template('submenu-page.php') || is_page_template('top-submenu-page.php')): ?>
		<?php $sub_menu = do_shortcode('[pods field="add_submenu"]'); ?>
		<?php if ($sub_menu): ?>
			<!-- <div class="submenu-scroll"> -->
				<?php the_content(); ?>
			<!-- </div> -->
		<?php else: ?>
			<?php the_content(); ?>
		<?php endif; ?>
	<?php else: ?>
		<?php the_content(); ?>
	<?php endif; ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'westminster_academy' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php edit_post_link( __( 'Edit', 'westminster_academy' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
