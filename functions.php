<?php
/**
 * opensauce functions and definitions
 *
 * @package opensauce
 */

/**
 * Include custom post types
 */
include_once( get_template_directory() . '/post-types/recipe.php' );
include_once( get_template_directory() . '/taxonomies/ingredient.php' );
include_once( get_template_directory() . '/taxonomies/unit.php' );

/**
 * Include helper classes
 */
include_once( get_template_directory() . '/inc/class-recipe-functions.php' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'opensauce_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function opensauce_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on opensauce, use a find and replace
	 * to change 'opensauce' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'opensauce', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails', array( 'post', 'recipe' ) );


    /**
     * Add excerpts to post types
     */
    add_post_type_support( 'post', 'excerpt' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'opensauce' ),
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
	add_theme_support( 'custom-background', apply_filters( 'opensauce_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // opensauce_setup
add_action( 'after_setup_theme', 'opensauce_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function opensauce_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'opensauce' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'opensauce_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function opensauce_scripts() {
    wp_enqueue_style( 'opensauce-style', get_template_directory_uri() . '/css/styles.css' );
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/bower_components/swiper/dist/css/swiper.min.css' );

    wp_deregister_script( 'jquery' );
    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/bower_components/jquery/dist/jquery.min.js', array(), filemtime( get_template_directory() . '/bower_components/jquery/dist/jquery.min.js' ), true );
    wp_enqueue_script( 'swiper', get_template_directory_uri() . '/bower_components/swiper/dist/js/swiper.min.js', array( 'jquery' ), filemtime( get_template_directory() . '/bower_components/swiper/dist/js/swiper.min.js' ), true );
    wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.min.js', array( 'jquery' ), filemtime( get_template_directory() . '/js/main.min.js'), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'opensauce_scripts' );

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


/**
 * Admin tweaks
 */
function opensauce_admin_tweaks() {
    remove_meta_box( 'tagsdiv-unit', 'recipe', 'side' );
    remove_meta_box( 'postexcerpt', 'post', 'normal' );
}
add_action( 'admin_menu' , 'opensauce_admin_tweaks', 999 );
add_action( 'edit_form_after_title', 'post_excerpt_meta_box' );