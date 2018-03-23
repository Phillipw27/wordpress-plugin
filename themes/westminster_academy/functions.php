<?php
/**
 * westminster_academy functions and definitions
 *
 * @package westminster_academy
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'westminster_academy_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function westminster_academy_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on westminster_academy, use a find and replace
	 * to change 'westminster_academy' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'westminster_academy', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'westminster_academy' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'westminster_academy_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );
}
endif; // westminster_academy_setup
add_action( 'after_setup_theme', 'westminster_academy_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function westminster_academy_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'westminster_academy' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name' => 'Homepage Notification',
		'id' => 'notification-area',
		'before_widget' => '<div id="notification-area" class="widget %2$s"><div id="notification-wrapper"><div id="note-logo"><div class="close-note">X</div>',
		'after_widget'  => '</div></div></div>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',		
	) );
	
	register_sidebar( array(
		'name' => 'Facebook Footer',
		'id' => 'facebook-footer',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',		
	) );
	
	register_sidebar( array(
		'name' => 'Blogs Footer',
		'id' => 'blog-footer',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',		
	) );		
}
add_action( 'widgets_init', 'westminster_academy_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function westminster_academy_scripts() {
	wp_enqueue_style( 'westminster_academy-style', get_stylesheet_uri() );
	wp_enqueue_style( 'theme-style', '/wp-content/themes/westminster_academy/main.css' );
	
	wp_register_style('droid', 'http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic');
    wp_enqueue_style( 'droid');	

	wp_enqueue_script( 'westminster_academy-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'westminster_academy-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'scrollto', get_template_directory_uri() . '/js/scrollto.js', array(), true );
	wp_enqueue_script( 'theme-script', get_template_directory_uri() . '/js/script.js', array(), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'westminster_academy_scripts' );

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

// Custom functions
function add_first_and_last($output) {
  $output = preg_replace('/class="menu-item/', 'class="first menu-item', $output, 1);
  $output = substr_replace($output, 'class="last menu-item', strripos($output, 'class="menu-item'), strlen('class="menu-item'));
  return $output;
}
add_filter('wp_nav_menu', 'add_first_and_last');

// search-form
function my_search_form( $form ) {
    $form = '<div id="searchform-wrapper"><form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <div><label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
    <input type="text" placeholder="Keyword Search" value="' . get_search_query() . '" name="s" id="s" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" />
    </div>
    </form></div>';

    return $form;
}

add_filter( 'get_search_form', 'my_search_form' );


function has_sidebar($classes) {
    if (is_active_sidebar('sidebar-1') || is_active_sidebar('sidebar-2')) {
        // add 'class-name' to the $classes array
        $classes[] = 'one-sidebar';
    }
    // return the $classes array
    return $classes;
}
add_filter('body_class','has_sidebar');

function no_sidebar($classes) {
    if (!is_active_sidebar('sidebar-1') && !is_active_sidebar('sidebar-2')) {
        // add 'class-name' to the $classes array
        $classes[] = 'full-width';
    }
    // return the $classes array
    return $classes;
}
add_filter('body_class','no_sidebar');

function two_sidebar($classes) {
    if (is_active_sidebar('sidebar-1') && is_active_sidebar('sidebar-2')) {
        // add 'class-name' to the $classes array
        $classes[] = 'two-sidebar';
    }
    // return the $classes array
    return $classes;
}
add_filter('body_class','two_sidebar');
