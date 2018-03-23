<?php
/**
 * westminster-sig functions and definitions
 *
 * @package westminster-sig
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'westminster_sig_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function westminster_sig_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on westminster-sig, use a find and replace
	 * to change 'westminster-sig' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'westminster-sig', get_template_directory() . '/languages' );

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
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'westminster-sig' ),
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
	add_theme_support( 'custom-background', apply_filters( 'westminster_sig_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // westminster_sig_setup
add_action( 'after_setup_theme', 'westminster_sig_setup' );

add_theme_support( 'post-thumbnails', array( 'post','staff-member' ) );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function westminster_sig_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Logo', 'westminster-sig' ),
		'id'            => 'top-logo',
		'description'   => '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Top', 'westminster-sig' ),
		'id'            => 'top-page',
		'description'   => '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'westminster-sig' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Bottom', 'westminster-sig' ),
		'id'            => 'bottom-page',
		'description'   => '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer', 'westminster-sig' ),
		'id'            => 'bottom-footer',
		'description'   => '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
register_sidebar( array(
		'name'          => __( 'Footer Scripts', 'westminster-sig' ),
		'id'            => 'footer-scripts',
		'description'   => '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<!-- ',
		'after_title'   => '<-->',
	) );
	
}
add_action( 'widgets_init', 'westminster_sig_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function westminster_sig_scripts() {
	wp_enqueue_style( 'westminster-sig-style', get_stylesheet_uri() );

wp_enqueue_style( 'westminster-sig-boilerplate', get_template_directory_uri() . '/css/boilerplate.css', array(), '20120206', true );
//wp_enqueue_style( 'westminster-sig-responsive', get_template_directory_uri() . '/css/responsive.css', array(), '20120206', true );

	wp_enqueue_script( 'westminster-sig-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'westminster-sig-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	wp_enqueue_script( 'westminster-sig-respond', get_template_directory_uri() . '/js/respond.min.js', array(), '20150128', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'westminster_sig_scripts' );


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

add_filter('wprss_ftp_skip_image_size_check', 'wprss_ftp_skip_image_size_check_custom');
function wprss_ftp_skip_image_size_check_custom(){
	return TRUE;
}

add_filter('cron_request', 'my_increase_cron_request_timeout');
	function my_increase_cron_request_timeout($args) {
		$args['args']['timeout'] = 1; // Seconds. Increase as needed.
		return $args;
	}
 
function westmister_sig_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
     	<div class="comment-avatar">
        <?php //echo get_avatar($comment,$size='48',$default='http://1.gravatar.com/avatar/a20ce1302dc50e932fb18232a6147b5b?s=32&d=mm&r=g' ); ?>
         <img src="/wp-content/uploads/2015/07/default-avatar.png" class="avatar">
         </div>
      <div class="comment-author vcard">
         <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author()) ?>
         <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('<br>Your comment is awaiting moderation.') ?></em>
        
      <?php endif; ?> <br />
      <?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?>
      </div>
      
 
      <div class="comment-meta commentmetadata">
          
          <?php edit_comment_link(__('(Edit)'),'  ','') ?>
      </div>
 	<div class="clear"></div>
      <?php comment_text() ?>
 
      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
     </div>
<?php
        }
?>