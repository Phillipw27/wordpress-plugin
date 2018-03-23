<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package westminster-sig
 */

get_header(); ?>

<div id="primary" class="content-area template-five">
   
		<main id="main" class="site-main" role="main">
        
        
      
        <div class="secondary-content-wrapper">                 	
            <div class="gridContainer clearfix">
            <div class="gold-sidebar fluid one-third">
                <?php get_sidebar(); ?>
                </div>
	            <div class="secondary-content fluid two-thirds">

				 <div class="blog_wrap">
                   <?php if ( have_posts() ) : ?>
                   
				<?php
					the_archive_title( '<h1>', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			
	<?php /* Start the Loop */ ?>
    <ul class="alm-listing alm-ajax "  style="margin-bottom:100px;" >
                <?php while ( have_posts() ) : the_post(); ?>
    <?php
$imgclass='class="has-img"';
if (has_post_thumbnail()) { 
	$defaultimage=strpos(get_the_post_thumbnail(),'buttonw');
if ($defaultimage>0){
	$imgclass='class="no-img"';
} 
} else {
	$imgclass='class="no-img"';
}
?>
<li <?php echo($imgclass); ?>><?php if ( $imgclass=='class="has-img"' ) {
echo ('<a href="');
the_permalink();
echo('" title="');
the_title();
echo('">');
the_post_thumbnail(array(100,100));
echo ('</a>');
}?> 
                  
<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
<div class="entry-meta">Posted <?php the_time("F d, Y"); ?> by <a class="url fn n" href="<?php echo(esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() )); ?></a></div>
<?php
if ( comments_open() || '0' != get_comments_number() ) :
								?><div  class="comment-meta"><a href="<?php the_permalink(); ?>#comments" title="<?php the_title(); ?>#comments"><?php comments_number( 'Leave Comment', '1 Comment', '% Comments' ); ?></a></div><?php							
							endif;
							?><div class="excerpt"><?php the_excerpt(); ?></div></li>
    
                <?php endwhile; ?>
    
                <?php the_posts_navigation(); ?>
                <?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>
</div>
</ul>

		<?php endif; ?>
				 
                </div>
                </div>
                </div>
            </div>

				 

<div class="clear"></div>
		</main><!-- #main -->
        <div class="content-shadow bottom">&nbsp;</div>
	</div><!-- #primary -->
    
    
    
		
 
<?php get_footer(); ?>
