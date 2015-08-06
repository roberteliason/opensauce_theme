<?php
/**
 * opensauce functions and definitions
 *
 * @package opensauce
 */

/**
 * Include custom post types and taxonomies
 */
include_once( get_template_directory() . '/post-types/recipe.php' );
include_once( get_template_directory() . '/taxonomies/ingredient.php' );
include_once( get_template_directory() . '/taxonomies/unit.php' );
include_once( get_template_directory() . '/taxonomies/recipe_type.php' );

/**
 * Include helper classes
 */
include_once( get_template_directory() . '/inc/class-recipe-functions.php' );
include_once( get_template_directory() . '/inc/class-opensauce-nav-walker.php' );
include_once( get_template_directory() . '/inc/class-recipe-print.php' );


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

    // Add custom image size for teasers
    add_image_size( 'teaser', 600, 400 );
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
		'id'            => 'sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Front Page', 'opensauce' ),
		'id'            => 'frontpage',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'opensauce_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function opensauce_scripts() {
	opensauce_maybe_enqueue_styles( 'opensauce-style', '/css/styles.css' );
	opensauce_maybe_enqueue_styles( 'swiper', '/bower_components/swiper/dist/css/swiper.min.css' );
	opensauce_maybe_enqueue_styles( 'magnific', '/bower_components/magnific-popup/dist/magnific-popup.css' );

	if ( file_exists( get_template_directory() . '/bower_components/jquery/dist/jquery.min.js' ) ) {
		wp_deregister_script( 'jquery' );
		opensauce_maybe_enqueue_script( 'jquery', '/bower_components/jquery/dist/jquery.min.js', array() );
	}
	opensauce_maybe_enqueue_script( 'swiper', '/bower_components/swiper/dist/js/swiper.min.js', array( 'jquery' ) );
	opensauce_maybe_enqueue_script( 'magnific', '/bower_components/magnific-popup/dist/jquery.magnific-popup.min.js', array( 'jquery' ) );
	// opensauce_maybe_enqueue_script( 'main-js', '/js/main.min.js', array( 'jquery' ) );
	opensauce_maybe_enqueue_script( 'main-js', '/js/main.js', array( 'jquery' ) );

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


/**
 * Custom main menu
 */
function opensauce_render_main_menu() {
    wp_nav_menu(
        array(
            'theme_location'  => 'primary',
            'menu_class'      => 'navigation-menu show',
            'menu_id'         => 'js-navigation-menu',
            'container'       => 'nav',
            'container_class' => 'navigation',
            'walker'          => new Opensauce_Nav_Walker
        )
    );
}


/**
 * A cautious approach to enqueuing js dependencies
 *
 * @param $script_slug
 * @param $script_path
 * @param $script_depends
 */
function opensauce_maybe_enqueue_script( $script_slug, $script_path, $script_depends ) {
	if ( file_exists( get_template_directory() . $script_path ) ) {
		wp_enqueue_script( $script_slug, get_template_directory_uri() . $script_path, $script_depends, filemtime( get_template_directory() . $script_path ), true );
	}

}


/**
 * A cautious approach to enqueuing css dependencies
 *
 * @param $style_slug
 * @param $style_path
 */
function opensauce_maybe_enqueue_styles( $style_slug, $style_path ) {
	if ( file_exists( get_template_directory() . $style_path ) ) {
		wp_enqueue_style( $style_slug, get_template_directory_uri() . $style_path );
	}
}
