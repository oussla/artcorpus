<?php
/**
 * Template part for displaying artists grid.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Art_Corpus
 */


?>

<section class="artists-grid background-black">

<h3>Tous les artistes</h3>


<?php 

// Get all artists 
$args = array(
	'post_type' => 'artist',
	'posts_per_page' => 24
);


$query = new WP_Query( $args );

if ($query->have_posts()) {
	
	while($query->have_posts()) {

		$query->the_post();
		$name = get_field('name');
		if($name == '') $name = get_the_title();

		?>
		<a href="<?php echo get_permalink(); ?>">
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