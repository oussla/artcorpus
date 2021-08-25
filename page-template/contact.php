<?php
/**
 * Template Name: Contact
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Art_Corpus
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<div class="columns">
		
			<section class="first post-single column column-2-3">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

				endwhile; // End of the loop.
				?>

			</section>


			<?php
			
			/**
			 * Widget area: contact-sidebar.
			 */
			if ( is_active_sidebar( 'contact-sidebar' ) ) : ?>
				<aside class="widget-area contact-sidebar column column-1-3" role="complementary">
					<?php dynamic_sidebar( 'contact-sidebar' ); ?>
				</aside><!-- .contact-sidebar -->
				<?php 
			endif; 

			?>

		</div><!-- .columns -->

		<?php

			/**
			 *	Add BYCH: Before You Come Here
			 */
			get_template_part( 'template-parts/bych');

		?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer('contact');
