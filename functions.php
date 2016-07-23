<?php
/**
 * Art Corpus functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Art_Corpus
 */

if ( ! function_exists( 'artcorpus_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function artcorpus_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Art Corpus, use a find and replace
	 * to change 'artcorpus' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'artcorpus', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'artcorpus' ),
		'subhead' => esc_html__( 'Subhead Menu', 'artcorpus'),
		'footer' => esc_html__( 'Footer Menu', 'artcorpus')
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'artcorpus_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );


	// Remove emoji support
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );

}
endif;
add_action( 'after_setup_theme', 'artcorpus_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function artcorpus_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'artcorpus_content_width', 640 );
}
add_action( 'after_setup_theme', 'artcorpus_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function artcorpus_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'artcorpus' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Identity', 'artcorpus' ),
		'id'            => 'footer-identity',
		'description'   => '',
		'before_widget' => '<address>',
		'after_widget'  => '</address>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );


}
add_action( 'widgets_init', 'artcorpus_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function artcorpus_scripts() {
	wp_enqueue_style( 'artcorpus-style', get_stylesheet_uri() );

	wp_enqueue_script( 'artcorpus-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'artcorpus-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );


	if( !is_admin()){
	  
	  wp_deregister_script('jquery');
	  wp_enqueue_script('jquery', get_template_directory_uri() . "/vendors/jquery-2.2.2.min.js", array(), "2.2.2", true);
	  wp_enqueue_script('masonry', get_template_directory_uri() . "/vendors/masonry.pkdg.min.js", array('jquery'), "4.0.0", true);
	  wp_enqueue_script('googlemap', "https://maps.googleapis.com/maps/api/js?key=AIzaSyCsh1aWAM2_fdE4KYghJ-yLry9qWQGhLOI", array(), "1", true);
	  wp_enqueue_script('slick', get_template_directory_uri() . "/vendors/slick/slick.min.js", array('jquery'), false, true);
	  wp_enqueue_style('slick_style', get_template_directory_uri() . "/vendors/slick/slick.css", array(), false, "all");
	  wp_enqueue_script('lightgallery', get_template_directory_uri() . "/vendors/lightgallery/js/lightgallery.min.js", array('jquery'), false, true);
	  wp_enqueue_style('lightgallery_style', get_template_directory_uri() . "/vendors/lightgallery/css/lightgallery.min.css", array(), false, "all");
	  wp_enqueue_script('main', get_template_directory_uri() . "/js/main.js", array('jquery', 'masonry', 'googlemap', 'slick', 'lightgallery'), false, true);
	  
	}


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'artcorpus_scripts' );


/**
 * TEST FILTER 
 * for post overriding post thumbnails
 */
function artcorpus_post_thumbnail_html($html) {
	return "YOYO".$html."OYOY";

}
add_filter( 'post_thumbnail_html', 'artcorpus_post_thumbnail_html', 11 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
