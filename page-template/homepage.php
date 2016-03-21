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


	<h2>En ce moment...</h2>
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

		<hr />

		<?php



		/**
		 *	Add beforeYouComeHere: BYCH
		 */
		get_template_part( 'template-parts/bych');

		?>

		<hr />


		<h2>Les artistes</h2>
		<?php



		/**
		 *	Loop on main Artists, ignoring guests
		 */
		$args = array(
			'post_type' => 'artist',
			'meta_query' => array(
				array(
					'key'     => 'guest',
					'value'   => 0,
					'compare' => '=',
				)
			),
			'ignore_sticky_posts' => 1
		);
		$artists_query = new WP_Query( $args );

		while ( $artists_query->have_posts() ) : $artists_query->the_post();
			?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

			</div>
			<?php
		endwhile;

		wp_reset_postdata();

		?>

		<hr />



		<h2>Les guests</h2>
		<?php


		/**
		 *	Loop on Guests
		 */
		$args = array(
			'post_type' => 'artist',
			'meta_query' => array(
				array(
					'key'     => 'guest',
					'value'   => 1,
					'compare' => '=',
				)
			),
			'ignore_sticky_posts' => 1
		);
		$artists_query = new WP_Query( $args );

		while ( $artists_query->have_posts() ) : $artists_query->the_post();
			?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

			</div>
			<?php
		endwhile;
		
		wp_reset_postdata();


		?>

		<hr />


		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">


			<?php

			/**
			 * Loop alongs the News posts (articles)
			 */
			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) : ?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>

				<?php
				endif;

				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
