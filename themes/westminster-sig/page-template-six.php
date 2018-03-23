<?php
/**

* Template Name: Template Six Page

*/

get_header(); ?>

	<div id="primary" class="content-area template-six">
   
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
            
            
            <div class="secondary-content-wrapper"> 
                
	            <div class="secondary-content">

				<?php get_template_part( 'content', 'page' ); ?>
                </div>
            </div>

				 

			<?php endwhile; // end of the loop. ?>
<div class="clear"></div>
		</main><!-- #main -->
        <div class="content-shadow bottom">&nbsp;</div>
	</div><!-- #primary -->


<?php get_footer(); ?>
