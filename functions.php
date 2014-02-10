<?php
/**
 * smart functions and definitions
 *
 * @package smart
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'smart_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function smart_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on smart, use a find and replace
	 * to change 'smart' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'smart', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'smart' ),
	) );

	// Enable support for Post Formats.
	//add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'smart_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
}
endif; // smart_setup
add_action( 'after_setup_theme', 'smart_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function smart_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'smart' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'smart_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function smart_scripts() {
	wp_enqueue_style( 'foundation-custom', get_template_directory_uri() . '/foundation-custom.css');

	wp_enqueue_style( 'wp-core-styles', get_template_directory_uri() . '/css/wp-core-styles.css');

	wp_enqueue_style( 'smart-style', get_stylesheet_uri() );

	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'foundation-script', get_template_directory_uri() . '/js/foundation.min.js', array('jquery'), false, true);
	
	wp_enqueue_script( 'foundation-topbar-script', get_template_directory_uri() . '/js/foundation/foundation.topbar.js', array('jquery', 'foundation-script'), false, true);

	wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js', array('jquery'), false, true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'smart_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require_once get_template_directory() . '/inc/custom-header.php';

/**
 * Load Matthew Ruddy image resizer file.
 */
require_once get_template_directory() . '/inc/image-resizer.php';

/**
 * Load custom Foundation walker file.
 */
require_once get_template_directory() . '/inc/foundation-walker.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require_once get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require_once get_template_directory() . '/inc/jetpack.php';
