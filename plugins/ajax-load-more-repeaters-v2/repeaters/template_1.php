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