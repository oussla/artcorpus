<?php
/**
 * Template part for displaying the "Before You Come Here" message.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Art_Corpus
 */


?>

<section class="bych">

	<div class="section-content">
	<?php

		$pageID = get_option('artcorpus_bychpage');

	?>

		<div class="pointing pointing-right"></div>

		<a href="<?php echo get_permalink($pageID); ?>">
			<img src="<?php echo get_template_directory_uri(); ?>/img/svg/bych.svg" alt="<?php _("Avant de passer à la boutique", "artcorpus"); ?>" />
		</a>

		<div class="pointing pointing-left"></div>
	</div>

</section>