<?php
/**
 * The template for displaying all single posts.
 *
 * @package westminster-sig
 */

get_header(); ?>
<div id="primary" class="content-area template-five">
   
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
         
            <?php while ( have_posts() ) : the_post(); ?>
            <div class="secondary-content-wrapper">                 	
            <div class="gridContainer clearfix">
            <div class="gold-sidebar fluid one-fourth">
                <?php get_sidebar(); ?>
                </div>
	            <div class="secondary-content fluid two-thirds">

				 <div class="blog_wrap">

				<?php get_template_part( 'content', 'single' ); ?>
                <?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || '0' != get_comments_number() ) :
								comments_template();
							endif;
						?>
                </div>
                </div>
                </div>
            </div>

				 

			<?php endwhile; // end of the loop. ?>
<div class="clear"></div>
		</main><!-- #main -->
        <div class="content-shadow bottom">&nbsp;</div>
	</div><!-- #primary -->
<script language="javascript">
jQuery(function() {

	
	jQuery('.widget_nav_menu ul').each(function() {
    var select = jQuery(document.createElement('select')).insertBefore(jQuery(this).hide());
    jQuery('>li a', this).each(function() {
        var a = jQuery(this).click(function() {
            if (jQuery(this).attr('target')==='_blank') {
                window.open(this.href);
            }
            else {
                window.location.href = this.href;
            }
        }),
        option = jQuery(document.createElement('option')).appendTo(select).val(this.href).html(jQuery(this).html()).click(function() {
            a.click();
        });
		
    });
	select.prepend("<option value='' selected='selected'>Select page</option>");
});


	}
	
});	

</script>


 
<?php get_footer(); ?>
