<?php
/**
 * Template part for displaying artist availability.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Art_Corpus
 */


?>

<section class="artist-availability">

<?php

	// If artist name is not defined, get the page title by default. 
	$name = get_field('name');
	if($name == '') $name = get_the_title();

	$avails = get_field('availability');
	$availSpecial = get_field('availability_special');
	$today = strtolower(strftime("%A"));

?>

<?php

	$todayWeekDayNum = date('N');
	$todayAvail = in_array("weekday".($todayWeekDayNum), $avails);

?>

	<div class="available-today available-<?php echo ($todayAvail ? 'true' : 'false'); ?>">

		<?php printf(esc_html__('Est-ce que %s est à la boutique le %s ?', 'artcorpus'), $name, $today); ?><br />

		<?php

		if($todayAvail) {
			echo esc_html__('Oui.', 'artcorpus').'<span class="small">'.esc_html__('(si tout va bien)', 'artcorpus').'</span>';
		} else {
			echo esc_html__('Aaah... non.', 'artcorpus');
		}

		?>

	</div>


<?php

	// Calling template to get the availability table
	artcorpus_artists_availability_table($avails, $availSpecial, array('displayWeekDays' => true));


	/**
	 * Static template 
	 */
	
	/*
	<table class="availability">
		<tr class="weekdays">
			<td>lundi</td>
			<td>mardi</td>
			<td class="available-false">mercredi</td>
			<td>jeudi</td>
			<td>vendredi</td>
			<td>samedi</td>
			<td>dimanche</td>
		</tr>
		<tr class="avails">
			<td class="available-true" colspan="2"></td>
			<td class="available-false"></td>
			<td class="available-true" colspan="3"></td>
			<td class="available-false"></td>
		</tr>
	</table>
	*/

	?>

</section>