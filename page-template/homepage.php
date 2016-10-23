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

		<section class="first posts-list sticky highlight white background-white">
			<div class="section-content">
				<div class="sticky-title">
					<h3><?php _e('En ce moment chez', 'artcorpus'); ?></h3>
					<h2><?php _e('Art Corpus', 'artcorpus'); ?></h2>
				</div>
				<?php

					/**
					 *	Add sticky post
					 */
					$sticky = get_option( 'sticky_posts' );
					$args = array(
						'posts_per_page' => 1,
						'post__in'  => $sticky,
						'ignore_sticky_posts' => 1
					);
					$sticky_query = new WP_Query( $args );


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


			/**
			 *	Add BYCH: Before You Come Here
			 */
			get_template_part( 'template-parts/bych');


			/**
			 * In-house artists-only grid. 
			 */
			artcorpus_artists_grid(ARTISTS_GRID_ARTISTS);


			/**
			 * Guests. 
			 */
			artcorpus_artists_grid(ARTISTS_GRID_GUESTS, 'white');

		?>

		<section class="posts-list white">

			<div class="section-content">

				<h2 class="title-checkmarks"><span><?php echo esc_html__('les news du shop', 'artcorpus'); ?></span></h2>

				<?php

					/**
					 * Get latest Facebook posts
					 */
					$fb_posts = array();
					if(function_exists('recent_facebook_posts')) {
						// Get raw posts, through RFBP singleton instance, for future custom templating
						$fb_posts = RFBP_Public::instance()->get_posts();
					}

					/**
					 *	Add N latest news
					 */
					$sticky = get_option( 'sticky_posts' );
					$args = array(
						'posts_per_page' => 5,
						'post_type' => 'post',
						'post__not_in' => $sticky,
						'ignore_sticky_posts' => 1
					);
					$latest_query = new WP_Query( $args );


					// Merge arrays
					$global_posts = array_merge($latest_query->get_posts(), $fb_posts);

					// Sort by post date (keep in mind that we have different post types here)
					usort($global_posts, 'artcorpus_compare_posts_dates');

					// Limit to X posts, after sorting
					$global_posts = array_slice($global_posts, 0, 10);

					foreach ($global_posts as $post) {
						if(isset($post) && is_object($post)) {
							// This is a Wordpress post, so continue with the loop. 
							$latest_query->the_post();
							get_template_part( 'template-parts/content', 'excerpt' );
						} elseif (is_array($post)) {
							// This is a Facebook post, so display a custom template.
							artcorpus_format_facebook_post($post);
						} else {
							// WTF could this be!?
						}
					}

					wp_reset_postdata();

				?>

				<a class="button highlight" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"><?php _e('toutes les news', 'artcorpus'); ?></a>

			</div>
			
		</section>

	
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
