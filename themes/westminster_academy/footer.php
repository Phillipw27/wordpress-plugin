<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package westminster_academy
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-border"></div>
		<div class="mw">
			<div class="visit-us facebook-visit-us">
    			<?php if ( ! dynamic_sidebar( 'facebook-footer' ) ) : ?>
    			<?php endif; ?>
				<!-- <p>See what we have been up to on <a href="https://www.facebook.com/westminsteracademymemphis">FACEBOOK</a>.</p> -->
				<div id="left-vert-border"></div>
			</div>	
			<div class="wma-info mobile-hide">
				<h1>Westminster Academy</h1>
				<p>2500 Ridgeway Road, Memphis, Tennessee 38119<br />
				901.380.9192 <!-- + <a href="#">info@wamemphis.com</a> + <a href="#">Facebook</a> --></p>
			</div>
			<div class="donation">
				<div id="right-vert-border"></div>			
				<!-- <p>Get to know our teachers <a href="/our-people">READ THE BLOGS</a></p> -->
				<?php if ( ! dynamic_sidebar( 'blog-footer' ) ) : ?>
				<?php endif; ?>
			</div>	
			
			<!-- FOR MOBILE ONLY -->
			<div class="wma-info wma-info-mobile tablet-hide desktop-hide">
				<h1>Westminster Academy</h1>
				<p>2500 Ridgeway Road<br />Memphis, Tennessee 38119<br />
				901.380.9192<br />
				<a href="mailto:info@wamemphis.com">info@wamemphis.com</a><br />
				<a href="https://www.facebook.com/westminsteracademymemphis">Facebook</a></p>
			</div>
		</div>
		<?php get_search_form(); ?>
	</footer><!-- #colophon -->
	<div class="footer-border"></div>	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
