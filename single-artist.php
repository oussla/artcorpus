<?php
/**
 * The template for displaying artists. 
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Art_Corpus
 */

get_header(); ?>

	<!-- TEMPLATE : single-artist.php -->

	<?php

		// Do we have to display a disclaimer ?
		$disclaimer = get_field('disclaimer') == 1;

		if($disclaimer) {
			echo artcorpus_disclaimer();
		}

	?>

	<main id="main" class="site-main" role="main">

		<?php


		while ( have_posts() ) : the_post();

			// Is this artist a guest ? 
			$guest = get_field('guest') == 1;

			// Get the artist name
			$name = get_field('name');
			if($name == '') $name = get_the_title();

			// get the artist background 
			$background = "";
			$backgroundImage = get_field('background');
			if($backgroundImage != '') $background = 'style="background: url('.$backgroundImage['url'].') no-repeat top right;"';

			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?><?php echo $background; ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php echo $name; ?></h1>
					<?php 
						
						$job = get_field('job');
						if($job != ''):
							?>
							<h2 class="artist-job"><?php echo $job; ?></h2>
							<?php
						endif;

					?>

					<?php

						if($guest) {
							$guestStartDate = strftime('%#d %B', get_field('guest_date_start'));
							$guestEndDate = strftime('%#d %B %Y', get_field('guest_date_end'));

							?>

							<span class="guest-dates">
								<?php printf(esc_html__('en Guest chez Art Corpus du %s au %s', 'artcorpus'), $guestStartDate, $guestEndDate); ?>
							</span>

							<?php

						}

					?>

					<?php

						$portrait = get_field('portrait');
						echo wp_get_attachment_image($portrait['id'], 'large', false, array('class' => 'artist-portrait'));

						$has_sidecontent = get_field('has_sidecontent');
						if($has_sidecontent == 1) {
							echo '<div class="sidecontent">';
							echo get_field('sidecontent');
							echo '</div>';
						} else {
							the_post_thumbnail('large', array('class' => 'artist-main')); 
						}

					?>
				</header><!-- .entry-header -->

				<div class="dot"></div>
			
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


				<?php

					/**
	 				 * Artist's availability. 
	 				 */
					get_template_part( 'template-parts/artist', 'availability' );

				?>


				<section class="gallery background-black">

					<?php

						/**
						 * Masonry + PhotoSwipe gallery
		 				 */
		 				
		 				$gallery = get_field('gallery');

		 				if( $gallery ): ?>
							<div class="grid">
							<?php foreach( $gallery as $image ): ?>
								<a href="<?php echo $image['url']; ?>" class="grid-item">
									<?php echo wp_get_attachment_image($image['id'], 'gallery_medium'); ?>
								</a>
							<?php endforeach; ?>
							</div>
						<?php endif; 

					?>
		 			
				</section>


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


		<?php

			/**
			 * Others artists grid. 
			 */
			artcorpus_artists_grid(ARTISTS_GRID_ALL);

		?>


	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
