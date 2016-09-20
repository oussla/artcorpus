<?php
/**
 * Template part for displaying posts excerpt.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Art_Corpus
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php

	if(has_post_thumbnail()):
	?>
		<a href="<?php the_permalink(); ?>" rel="bookmark" class="post-thumbnail-wrapper">
			<?php the_post_thumbnail($size = 'post-thumbnail', array('class' => 'post-thumbnail')); ?>
		</a>
	<?php
	endif;

	?>


	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php artcorpus_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->


	<div class="entry-content">
		<?php

			if ( is_single() ) {
				the_content();
			} else {
				the_excerpt();
				echo artcorpus_read_more_link();
			}

			// the_content();

			// echo artcorpus_read_more_link();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'artcorpus' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
