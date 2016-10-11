<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Art_Corpus
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function artcorpus_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'artcorpus_body_classes' );





/**
 * Compare posts dates, as posts can be complex / multiple different formats. 
 * For exemple, allow comparison between "classic" Wordpress post and Facebook post from RFP plugin. 
 * @param  Array/Object 	$p1 	Wordpress post object or Facebook post array 
 * @param  Array/Object 	$p2 	Wordpress post object or Facebook post array 
 * @return int 				comparison between the two posts dates
 */
function artcorpus_compare_posts_dates($p1, $p2) {
	$date1 = (is_object($p1) ? strtotime($p1->post_date) : $p1['timestamp']);
	$date2 = (is_object($p2) ? strtotime($p2->post_date) : $p2['timestamp']);

	return $date1 < $date2 ? 1 : -1;
}