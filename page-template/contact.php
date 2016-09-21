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

		<section class="first post-single columns">

			<?php
			while ( have_posts() ) : the_post();

				?>
				<div class="column column-2-3">
					<?php
					get_template_part( 'template-parts/content', 'page' );
					?>
				</div>

				<div class="column column-1-3">
					<article>
						<?php
							$rightColumn = get_field('rightcolumn');
							echo $rightColumn;
						?>
					</article>
				</div>

				<?php

			endwhile; // End of the loop.
			?>

		</section>

		<section class="post-single white background-white">

			<h2 class="title-checkmarks"><span><?php echo _('Est-ce que mon tatoueur/pierceur est là aujourd\'hui ?', 'artcorpus'); ?></span></h2>

			<div class="artists-availabilities">
				<?php

				/**
				 * 1. Get all artists 
				 * 2. Loop and get all availabilities 
				 */
				

				// Get all artists 
				$args = array(
					'post_type' => 'artist',
					'posts_per_page' => 48,
					'ignore_sticky_posts' => 1
				);


				$query = new WP_Query( $args );

				if ($query->have_posts()) {
					
					$count = 0;
					$table = '<table class="availability">';

					while($query->have_posts()) {

						$query->the_post();
						$name = get_field('name');
						if($name == '') $name = get_the_title();

						$avails = get_field('availability');
						$availSpecial = get_field('availability_special');
						$table .= artcorpus_artists_availability_table($avails, $availSpecial, 
							array('displayWeekDays' => $count == 0, 
								  'name' => $name,
								  'addTable' => false, 
								  'echo' => false));

						$count ++;

					}

					$table .= '</table>';
					echo $table;
					
					// Restore original Post Data 
					wp_reset_postdata();
				}


				?>

			</div>

		</section>


		<?php

			/**
			 *	Add BYCH: Before You Come Here
			 */
			get_template_part( 'template-parts/bych');

		?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
