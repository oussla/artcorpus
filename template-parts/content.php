<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Art_Corpus
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php

	/**
	 *
	 * ### TODO : 
	 * - manage post thumbnail 
	 * - different post formats 
	 * 
	 */

	?>
	<?php the_post_thumbnail(); ?>

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

			the_excerpt();

			echo artcorpus_read_more_link();

			//esc_html__( 'lire la suite %s <span class="meta-nav">&rarr;</span>', 'artcorpus' );
			
			/*
			the_content( sprintf(
				/* translators: %s: Name of current post. *
				wp_kses( __( 'lire la suite %s <span class="meta-nav">&rarr;</span>', 'artcorpus' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
			*/

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'artcorpus' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
