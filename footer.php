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
	 * Widget area: footer-identity.
	 * Built as a widget area to allow contributing text from admin area
	 */
	if ( is_active_sidebar( 'footer-identity' ) ) : ?>
		<section class="footer-identity">
			<h3>Art Corpus</h3>
			<?php dynamic_sidebar( 'footer-identity' ); ?>
		</section>
	<?php endif; ?>


	<?php
	/**
	 * Map.
	 */
	?>
	<section class="footer-map">
		<div id="footermap" class="map"></div>
	</section>


	<?php
	/**
	 * Instagram feed plugin
	 */
	?>
	<section class="footer-instagram">
		<?php echo do_shortcode('[instagram-feed]'); ?>
	</section>



	<?php
	/**
	 * Bottom footer.
	 */
	?>
	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="footer-nav">
			<?php 
				wp_nav_menu( array( 'theme_location' => 'footer', 
									'menu_id' => 'footer-menu', 
									'container' => '', 
									'menu_class' => 'footer-menu' ) );
			?>
		</div>
		<div class="site-info">			
			<?php echo __( 'Toutes les images copyright Art Corpus, sauf mention contraire.', 'artcorpus' ); ?>

			<?php printf( esc_html__( 'Theme %1$s by %2$s.', 'artcorpus' ), 'artcorpus', '<a href="http://www.nicolaslagarde.com" rel="designer">Nicolas Lagarde</a>' ); ?>
		</div><!-- .site-info -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
