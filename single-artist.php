<?php
/**
 * The template for displaying artists. 
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Art_Corpus
 */

get_header(); ?>

	YO L'ARTISTE.
	<!-- TEMPLATE : single-artist.php -->

	<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

					<?php

						/**
						 * The Artist's portrait
						 */
						// the_post_thumbnail(); 

						/**
						 * The Artist's special work 
						 *
						 * TODO: to be replaced with simple ID, and img srcset ? 
						 * // see https://make.wordpress.org/core/2015/11/10/responsive-images-in-wordpress-4-4/
						 */
						$special = get_field('special_work_thumbnail');
						// var_dump($special);
						?>
						<img src="<?php echo $special['sizes']['medium']; ?>" 
							 alt="<?php echo $special['title']; ?>"
							 title="<?php echo $special['title']; ?>" />
						<?php

					?>
				</header><!-- .entry-header -->

			
				<div class="entry-content">
					<?php

						/**
		 				 * The classic page content
		 				 */
						the_content();

						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'artcorpus' ),
							'after'  => '</div>',
						) );

					?>
				</div><!-- .entry-content -->

				<section>

	 				<h2>GALLERY</h2>

					<?php

						/**
						 * TODO: artist's gallery. 
						 * Masonry + PhotoSwipe
		 				 */
		 				
		 				$gallery = get_field('gallery');
		 				// var_dump($gallery);

		 				if( $gallery ): ?>
						    <div class="grid">
						        <?php foreach( $gallery as $image ): ?>
					                <a href="<?php echo $image['url']; ?>" class="grid-item">
					                     <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
					                </a>
						        <?php endforeach; ?>
						    </div>
						<?php endif; ?>
		 			
				</section>


				<?php

					/**
	 				 * Artist's availability. 
	 				 */
					get_template_part( 'template-parts/artist', 'availability' );

				?>


			</article><!-- #post-## -->

			<?php

		endwhile; // End of the loop.
		?>



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
