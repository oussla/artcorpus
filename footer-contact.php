<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Art_Corpus
 */

?>

	</div><!-- #content -->

	<?php
	/**
	 * Map.
	 */
	?>
	<section class="footer-map large-map">
		<div id="footermap" class="map"></div>
	</section>


	<?php
	/**
	 * Bottom footer.
	 */
	?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">			
			<?php echo __( 'Toutes les images copyright Art Corpus, sauf mention contraire.', 'artcorpus' ); ?>

			<?php printf( esc_html__( 'Theme %1$s by %2$s.', 'artcorpus' ), 'artcorpus', '<a href="http://www.nicolaslagarde.com" rel="designer">Nicolas Lagarde</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
