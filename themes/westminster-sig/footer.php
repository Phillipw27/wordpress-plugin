<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package westminster-sig
 */
?>

	<footer id="colophon" class="site-footer" role="contentinfo">
    <div id="bottom-page">
            <?php dynamic_sidebar( 'bottom-page' ); ?>
            </div>
		<div class="site-info">
			<?php dynamic_sidebar( 'bottom-footer' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php dynamic_sidebar( 'footer-scripts' ); ?>
<?php wp_footer(); ?>

</body>
</html>
