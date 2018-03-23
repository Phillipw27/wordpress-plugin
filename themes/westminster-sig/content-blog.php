<?php
/**
 * @package westminster-sig
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	 
		<?php the_title( '<h2 >', '</h2>' ); ?>

		<div class="entry-meta">
			<?php westminster_sig_posted_on(); ?>
		</div><!-- .entry-meta -->
	 
 
		<?php the_content(); ?>
        <div class="read-more">
        <?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'westminster-sig' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>
        </div>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'westminster-sig' ),
				'after'  => '</div>',
			) );
		?>
	 
	 
</article><!-- #post-## -->
