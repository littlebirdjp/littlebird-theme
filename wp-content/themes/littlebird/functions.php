<?php
/**
 * littlebird functions and definitions
 *
 * @package littlebird
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'littlebird_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function littlebird_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on littlebird, use a find and replace
	 * to change 'littlebird' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'littlebird', get_template_directory() . '/languages' );

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
		'primary' => __( 'Primary Menu', 'littlebird' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'littlebird_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // littlebird_setup
add_action( 'after_setup_theme', 'littlebird_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function littlebird_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'littlebird' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'littlebird_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function littlebird_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bower_components/jbootstrap/dist/css/bootstrap.css' );
	wp_enqueue_style( 'bootstrap-theme', get_template_directory_uri() . '/bower_components/jbootstrap/dist/css/bootstrap-theme.css' );

	wp_enqueue_style( 'littlebird', get_stylesheet_uri() );

	wp_enqueue_style( 'littlebird-site', get_template_directory_uri() . '/bower_components/jbootstrap/dist/css/littlebird-site.css' );

	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' );

	wp_deregister_script( 'jquery'); //デフォルトの jQuery は読み込まない
	wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', array(), '1.11.1', false);
	wp_enqueue_script( 'jquery-mig', '//cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js', array(), '1.2.1', false);

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bower_components/jbootstrap/dist/js/bootstrap.min.js' );

	wp_enqueue_script( 'littlebird-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'littlebird-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'littlebird_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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

//RSSフィードとショートリンクを非表示
remove_filter( 'wp_head', 'feed_links', 2 );
remove_filter( 'wp_head', 'feed_links_extra', 3 );
remove_filter( 'wp_head', 'wp_shortlink_wp_head' );

// Get the featured image URL
function get_featured_image_url() { 
    $image_id = get_post_thumbnail_id();
    $image_url = wp_get_attachment_image_src($image_id,'thumbnail', true); 
    echo $image_url[0]; 
}
