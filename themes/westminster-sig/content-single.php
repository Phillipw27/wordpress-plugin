<?php
/**
 * @package westminster-sig
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	 
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        <div class="blogimage">
         <?php
$imgclass='';
if (has_post_thumbnail()) { 
	$defaultimage=strpos(get_the_post_thumbnail(),'buttonw');
if ($defaultimage>0){
	$imgclass='class="no-img"';
} 
} else {
	$imgclass='class="no-img"';
}
?>
<?php if ( $imgclass=='' ) { the_post_thumbnail();}?>
</div>
		<div class="entry-meta">
			<?php westminster_sig_posted_on(); ?>
            <?php
			if ( comments_open() || '0' != get_comments_number() ) :
								?>
                                <div  class="comment-meta"><a href="#comments" title="<?php the_title(); ?>#comments"><?php comments_number( 'Leave Comment', '1 Comment', '% Comments' ); ?></a></div>
                                <?php							
							endif;
							?>
            
		</div><!-- .entry-meta -->
	 

	<div class="entry-content">
		<?php the_content(); ?>
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
