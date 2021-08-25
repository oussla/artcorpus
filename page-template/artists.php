<?php
/**
 * Template Name: Artists
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Art_Corpus
 */

get_header(); ?>

	<main id="main" class="site-main" role="main">
        
		<section class="first post-single">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>

		</section>

		<section class="post-single">

			<article>
		
				<?php

					// Get all artists, 
                    // remove guests and artists with disclaimer
					$args = array(
						'post_type' => 'artist',
						'posts_per_page' => 48,
						'meta_query' => array(
							array(
								'key'     => 'guest',
								'value'   => 0,
								'compare' => '='
                            ),
                            array(
                                'key'     => 'disclaimer',
								'value'   => 0,
								'compare' => '='
                            )
						),
						'order' => 'ASC',
						'orderby' => 'meta_value_num',
						'meta_key' => 'rank',
						'ignore_sticky_posts' => 1
					);


					$query = new WP_Query( $args );


					if ($query->have_posts()) {

						?>
						<ul class="guests guests-alternate">
						<?php

						while($query->have_posts()) {

							$query->the_post();

							?>
							<li id="<?php echo get_post_field('post_name'); ?>">
								<?php

								$name = get_field('name');
								if($name == '') $name = get_the_title();

								$portrait = get_field('portrait');

								$thumbnail = get_the_post_thumbnail(null, 'gallery_large', array('class' => 'lazyload')); 
								$externalPage = get_field('guest_external_page');
                                $permalink = get_the_permalink();
								if($permalink != '') {
									$thumbnail = '<a href="'.$permalink.'">' . $thumbnail . '</a>';
								}
								echo $thumbnail;

								?>

								<div class="details">
									<h2 class=""><?php echo $name; ?></h2>

									<a href="<?php echo $permalink; ?>" target="_blank" class="button mb-05">
										<?php printf(esc_html__('Galerie de %s', 'artcorpus'), $name); ?>
									</a>

                                    <?php
									
									if($externalPage != '') {
										?>

										<a href="<?php echo $externalPage; ?>" class="block" target="_blank">
											<?php printf(esc_html__('Contacter %s', 'artcorpus'), $name); ?>
										</a>

										<?php
									}

									?>
								</div>
							</li>
							<?php
						}

						?>
						</ul>
						<?php
						
						// Restore original Post Data 
						wp_reset_postdata();
					}

				?>

			</article>

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
