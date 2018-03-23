<?php
/**

* Template Name: Template Three Page

*/

get_header(); ?>

	<div id="primary" class="content-area template-three">
   
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
            <div class="gold-sidebar fluid one-third">
                <?php get_sidebar(); ?>
                </div>
            
            <div class="secondary-content-wrapper fluid two-thirds">
            <?php $featured = do_shortcode('[pods field="featured_image"]'); ?>
                <?php if( $featured ): ?>
                    <?php $align = do_shortcode('[pods field="featured_text_alignment"]'); ?>
                    <div id="featured-image" class="<?php if ($align) { echo do_shortcode('[pods field="featured_text_alignment"]'); } else { echo 'right'; } ?>">
                    	<div class="image-wrapper">
                        <img src="<?php echo $featured; ?>" />
                        </div>
                        <?php $featured_text = do_shortcode('[pods field="featured_image_text"]'); ?>
                        <?php if ($featured_text): ?>
                        <div id="featured-text-wrapper">
                            <div class="featured-text"><?php echo $featured_text; ?></div>
                        </div>
                        
                        <?php endif; ?>
                        <div id="image-mask"></div>
                    </div>
                <?php endif; ?>		
				 
                
            
	            <div class="secondary-content">

				<?php get_template_part( 'content', 'page' ); ?>
                </div>
            </div>

				 

			<?php endwhile; // end of the loop. ?>
<div class="clear"></div>
		</main><!-- #main -->
        <div class="content-shadow bottom">&nbsp;</div>
	</div><!-- #primary -->


<script language="javascript">
 jQuery(function() {
	if (jQuery( window ).width() > 700){
		//setHeights();
	} else {
		     
	
	jQuery('.widget_nav_menu ul').each(function() {
    var select = jQuery(document.createElement('select')).insertBefore(jQuery(this).hide());
    jQuery('>li a', this).each(function() {
        var a = jQuery(this).click(function() {
            if (jQuery(this).attr('target')==='_blank') {
                alert("here->"+this.href);
				window.open(this.href);
            }
            else {
				alert("here2->"+this.href);
                window.location.href = this.href;
            }
        }),
        option = jQuery(document.createElement('option')).appendTo(select).val(this.href).html(jQuery(this).html()).click(function() {
            a.click();
        });
    });
	select.prepend("<option value='' selected='selected'>Select page</option>");
	select.attr("id","jumpbox");
	select.attr("onchange","selectjumpbox();");
});


	}
	
});	
function selectjumpbox(){
	//alert("here");
	window.location = jQuery('#jumpbox').find("option:selected").val();
}
</script>
<?php get_footer(); ?>
