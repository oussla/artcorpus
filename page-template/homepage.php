<?php
/**
 * Template Name: Homepage
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Art_Corpus
 */

get_header(); ?>

	<main id="main" class="site-main" role="main">

		<?php

		/**
		 *	Add sticky post,
		 *	Only if we explicitely have set some post sticky
		 */
		$sticky = get_option( 'sticky_posts' );
		$args = array(
			'posts_per_page' => 1,
			'post__in'  => $sticky,
			'ignore_sticky_posts' => 1
		);
		$sticky_query = new WP_Query( $args );
		if( isset($sticky[0]) ):
			?>

			<section class="first posts-list sticky highlight white background-white">
				<div class="section-content">
					<div class="sticky-title">
						<h3><?php _e('En ce moment chez', 'artcorpus'); ?></h3>
						<h2><?php _e('Art Corpus', 'artcorpus'); ?></h2>
					</div>
					<?php

						while ( $sticky_query->have_posts() ) : $sticky_query->the_post(); ?>

				            <?php
				                get_template_part( 'template-parts/content', 'excerpt' );
				            ?>

				        <?php endwhile;

						wp_reset_postdata();

					?>
				</div>
			</section>
	
			<?php
		endif;

		?>

        <?php
        /**
         * Instagram feed plugin
         */
        ?>
        <section class="footer-instagram background-black">
            <h3 class="title-checkmarks"><span><?php echo __( 'sur instagram', 'artcorpus' ); ?></span></h3>
            <?php echo do_shortcode('[instagram-feed]'); ?>
        </section>

		<?php

			/**
			 * In-house artists-only grid. 
			 */
			artcorpus_artists_grid(ARTISTS_GRID_ARTISTS);


			/**
			 * Guests. 
			 */
			artcorpus_artists_grid(ARTISTS_GRID_GUESTS, 'white');

		?>

		<section class="homepage-main-content">

			<?php
				if ( have_posts() ) :

					/* Start the Loop */
					while ( have_posts() ) : the_post();

						the_post_thumbnail();

						?>
						<section class="post-single">

							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="entry-content">
									<?php
										the_content();

										wp_link_pages( array(
											'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'artcorpus' ),
											'after'  => '</div>',
										) );
									?>
								</div><!-- .entry-content -->
							</article>

						</section>

						<?php

					endwhile;

				endif; 
			?>

		</section>

		<?php

			/**
			 *	Add BYCH: Before You Come Here
			 */
			get_template_part( 'template-parts/bych');

		?>
	
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
