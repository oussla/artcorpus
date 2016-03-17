<?php
/**
 * Template part for displaying artist availability.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Art_Corpus
 */


?>

YO AVAILABILITY.<br />

<?php

	$weekdayNames = array(
		'Monday',
		'Tuesday',
		'Wednesday', 
		'Thursday', 
		'Friday',
		'Saturday',
		'Sunday'
	);

	$avail = get_field('availability');

	for($i = 0; $i < 7; $i++) {

		echo __( $weekdayNames[$i], 'artcorpus' ) . ": ";
		if(in_array("weekday".($i + 1), $avail)) {
			echo "YES. ";
		} else {
			echo "NOPE. ";
		}
	}


?>