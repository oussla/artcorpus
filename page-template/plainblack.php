<?php
/**
 * Template Name: PlainBlack
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Art_Corpus
 */

get_header(); ?>

	<div id="primary" class="content-area background-plainblack plainblack centered">
		<main id="main" class="site-main" role="main">

		<section class="first post-single">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>

		</section>

		</main><!-- #main -->

		<?php

		the_post_thumbnail('large', array('class' => 'post-thumbnail')); 

		?>

	</div><!-- #primary -->


<?php
get_sidebar();
get_footer();
