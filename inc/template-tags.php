<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Art_Corpus
 */

if ( ! function_exists( 'artcorpus_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function artcorpus_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'artcorpus' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'artcorpus' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'artcorpus_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function artcorpus_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'artcorpus' ) );
		if ( $categories_list && artcorpus_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'artcorpus' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'artcorpus' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'artcorpus' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'artcorpus' ), esc_html__( '1 Comment', 'artcorpus' ), esc_html__( '% Comments', 'artcorpus' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'artcorpus' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function artcorpus_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'artcorpus_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'artcorpus_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so artcorpus_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so artcorpus_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in artcorpus_categorized_blog.
 */
function artcorpus_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'artcorpus_categories' );
}
add_action( 'edit_category', 'artcorpus_category_transient_flusher' );
add_action( 'save_post',     'artcorpus_category_transient_flusher' );



/**
 * Artists grids types
 */
define('ARTISTS_GRID_ALL', 'artists_grid_all');
define('ARTISTS_GRID_ARTISTS', 'artists_grid_artists');
define('ARTISTS_GRID_GUESTS', 'artists_grid_guests');


/**
 * Displays artists grid
 * @param  string $type Grid type, see constants above. 
 * @param  string $background Background color: 'black' / 'white'
 * @return void.
 */
/**
 * [artcorpus_artists_grid description]
 * @param  [type] $type       [description]
 * @param  string $background [description]
 * @return [type]             [description]
 */
function artcorpus_artists_grid($type = ARTISTS_GRID_ALL, $background = 'black') {

	// Get all artists 
	$args = array(
		'post_type' => 'artist',
		'posts_per_page' => 24,
		'meta_query' => array(
			array(
				'key'     => 'guest',
				'value'   => ($type == ARTISTS_GRID_ARTISTS ? 0 : ($type == ARTISTS_GRID_GUESTS ? 1 : array(0, 1))),
				'compare' => ($type == ARTISTS_GRID_ARTISTS ? '=' : ($type == ARTISTS_GRID_GUESTS ? '=' : 'IN')),
			)
		),
		'ignore_sticky_posts' => 1
	);

	?>

	<section class="artists-grid <?php echo ($type == ARTISTS_GRID_ARTISTS ? 'artists-only grid-big' : ($type == ARTISTS_GRID_GUESTS ? 'guests-only' : '')); ?> background-<?php echo $background; ?>">

	<?php

	?>
	<h2 class="title-checkmarks"><span><?php 
		echo esc_html__(($type == ARTISTS_GRID_ARTISTS ? 'les artistes' : ($type == ARTISTS_GRID_GUESTS ? 'les guests' : 'tous les artistes')), 'artcorpus');
	?></span></h2>
	<?php

	$query = new WP_Query( $args );

	if ($query->have_posts()) {
		
		while($query->have_posts()) {

			$query->the_post();
			$name = get_field('name');
			if($name == '') $name = get_the_title();

			?>
			<a href="<?php echo get_permalink(); ?>" class="grid-item">
			<h3 class="artist-name-button"><?php echo $name; ?></h3>
			<?php

			the_post_thumbnail('artist_grid'); 

			?>
			</a>
			<?php

		}
		
		// Restore original Post Data 
		wp_reset_postdata();
	}


	?>

	</section>

	<?php

}