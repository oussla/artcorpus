<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Art_Corpus
 */


/**
 * Define PHP locale
 */
switch(get_locale()) {
	case 'fr_FR': 
		$alternateLocale = 'fra';
		break;
	default: 
		$alternateLocale = 'eng';
		break;
}
setlocale(LC_TIME , get_locale().'.utf-8', $alternateLocale);


?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'artcorpus' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<div id="subhead" class="site-subhead">
			<?php 
				if(function_exists('pll_the_languages')):
				?>
					<ul class="polylang-menu">
						<?php 
						
							/**
							 * Custom Polylang language switcher. 
							 */
							$translations = pll_the_languages( array( 'raw' => 1 ) );

							foreach ($translations as $lang => $value) {
								?>
								<li<?php if($value['current_lang'] == 1) echo ' class="current-lang"'; ?>><a href="<?php echo $value['url']; ?>"><?php echo $value['slug']; ?></a></li>
								<?php
							}

						?>
					</ul>
				<?php
				endif;
			?>
			<?php wp_nav_menu( array( 'theme_location' => 'subhead', 'menu_id' => 'subhead-menu', 'container' => '', 'menu_class' => 'subhead-menu' ) ); ?>
		</div>

		<div class="site-branding">
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'artcorpus' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
