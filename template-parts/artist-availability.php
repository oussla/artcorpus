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



	<table class="availability">
	<?php

		// Setting an array with all translated weekdays.
		// Starts with "next Monday" as a first reference monday. 
		// Display all availabilities, per day. 
		$timestamp = strtotime('next Monday');
		$colspan = 1;

		$trWeekdays = '<tr class="weekdays">'.PHP_EOL;
		$trAvails = '<tr class="avails">'.PHP_EOL;

		for ($i = 0; $i < 7; $i++) {

		    $currentDayName = strtolower(strftime('%A', $timestamp));
		    // check current day availability
		    $currentAvail = in_array("weekday".($i + 1), $avails);
		    // same for next day
		    $nextAvail = in_array("weekday".($i + 2), $avails);

		    // display week day
		    $trWeekdays .= '<td class="available-'.($currentAvail ? 'true' : 'false').'">'.$currentDayName.'</td>'.PHP_EOL;

		    // calculate colspan and / or display
		    if($currentAvail != $nextAvail || $i == 6) {
		    	// Display current availability with calculated colspan
		    	$trAvails .= '<td class="available-'.($currentAvail ? 'true' : 'false').'" '.
		    					($colspan > 1 ? 'colspan="'.$colspan.'"' : '').'></td>'.PHP_EOL;
		    	// Reset colspan
		    	$colspan = 1;
		    } else {
		    	$colspan++;
		    }

		    $timestamp = strtotime('+1 day', $timestamp);
		}

		$trWeekdays .= '</tr>';
		$trAvails .= '</tr>';

		echo $trWeekdays . $trAvails;

	?>
	</table>


	<?php
	$availSpecial = get_field('availability_special');
	if($availSpecial != ''):
	?>
		<span class="availability-special"><?php echo $availSpecial; ?></span>
	<?php
	endif;



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