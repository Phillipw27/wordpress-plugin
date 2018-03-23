<?php
/**
 * @package westminster-sig
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<?php the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php westminster_sig_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'westminster-sig' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'westminster-sig' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php westminster_sig_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->