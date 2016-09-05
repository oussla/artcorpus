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

	YO HOMEPAGE.

	<header>

	<?php

		/**
		 *	Slideshow 
		 */
		$gallery = get_post_gallery_images();
		$image_list = '<div class="homeslideshow">';

		foreach( $gallery as $image_url ) {
			$image_list .= '<div>' . '<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-lazy="' . $image_url . '" alt="">' . '</div>';
		}
		$image_list .= '</div>';

		echo $image_list;

	?>

	</header>


	<main id="main" class="site-main" role="main">

	<h2><?php _e('En ce moment...', 'artcorpus'); ?></h2>
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
		if ( isset($sticky[0]) ) {

			while ( $sticky_query->have_posts() ) : $sticky_query->the_post();
				?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php the_content(); ?>

				</div>
				<?php
			endwhile;

		}
		wp_reset_postdata();

	?>

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


	<h2><?php _e('Les news du shop', 'artcorpus'); ?></h2>
	<?php

		/**
		 *	Add 10 latest news
		 */
		$sticky = get_option( 'sticky_posts' );
		$args = array(
			'posts_per_page' => 5,
			'post__not_in' => $sticky,
			'ignore_sticky_posts' => 1
		);
		$latest_query = new WP_Query( $args );

		while ( $latest_query->have_posts() ) : $latest_query->the_post();
			?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php the_content(); ?>

			</div>
			<?php
		endwhile;

		wp_reset_postdata();

	?>

	<hr />

	
	</main><!-- #main -->

	<?php

	/*


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


		<?php

		/**
		 * Loop alongs the News posts (articles)
		 *
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop *
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 *
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	*/

	?>

<?php
get_sidebar();
get_footer();
