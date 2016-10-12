<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Art_Corpus
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="page-single first error-404 not-found white">
				<header class="page-header double-title">
					<h2 class="title-checkmarks"><span><?php echo esc_html__('ah, c\'est une erreur', 'artcorpus'); ?></span></h2>
					<h1 class="page-title"><?php esc_html_e( 'il n\'y a rien ici.', 'artcorpus' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p>
						<a class="button" href="<?php echo home_url(); ?>"><?php echo esc_html__('Retourner à la page d\'accueil', 'artcorpus'); ?></a>
					</p>

					<?php
						// esc_html_e( 'It looks like nothing was found at this location. ', 'artcorpus' ); 
						// get_search_form();
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->


			<?php 

			/**
			 * In-house artists-only grid. 
			 */
			artcorpus_artists_grid(ARTISTS_GRID_ARTISTS);


			/**
			 * Guests. 
			 */
			artcorpus_artists_grid(ARTISTS_GRID_GUESTS, 'white');

			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
