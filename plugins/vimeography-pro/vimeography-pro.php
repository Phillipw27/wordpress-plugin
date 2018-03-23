<?php
/*
Plugin Name: Vimeography Pro
Plugin URI: http://vimeography.com/pro
Description: Vimeography Pro supercharges your Vimeography galleries by adding unlimited videos, custom sorting, Vimeo Pro support, download links, playlisting, hidden videos and more.
Version: 1.0.1
Requires: 3.5
Author: Dave Kiss
Author URI: http://www.davekiss.com/
Copyright: Dave Kiss
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists('json_decode') ) {
  wp_die('Vimeography PRO requires the JSON PHP extension.');
}

class Vimeography_Pro {

  /**
   * @var Vimeography_Pro The one true Vimeography_Pro
   * @since 1.0
   */
  private static $instance;


  /**
   * Vimeography_Pro Database Object
   *
   * @var object
   * @since 1.0
   */
  public $database;


  /**
   * Main Vimeography_Pro Instance
   *
   * Ensures that only one instance of Vimeography_Pro exists in memory at any one
   * time. Also prevents needing to define globals all over the place.
   *
   * @since 1.0
   * @static
   * @static var array $instance
   * @uses Vimeography_Pro::setup_constants() Setup the constants needed
   * @uses Vimeography_Pro::includes()        Include the required files
   * @uses Vimeography_Pro::load_textdomain() load the language files
   * @see  Vimeography_Pro()
   * @return The one true Vimeography_Pro
   */
  public static function instance() {
    if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Vimeography_Pro ) ) {
      self::$instance = new Vimeography_Pro;
      self::$instance->_define_constants();
      add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
      self::$instance->_includes();

      // Can be saved in public properties if need to access
      new Vimeography_Pro_Rewrite;
      new Vimeography_Pro_Loader;
      self::$instance->database = new Vimeography_Pro_Database;
      new Vimeography_Pro_Ajax;
      new Vimeography_Pro_Shortcode;
    }
    return self::$instance;
  }


  /**
   * Localization
   * @return [type] [description]
   */
  public function load_textdomain() {
    load_plugin_textdomain('vimeography-pro', false, dirname( VIMEOGRAPHY_PRO_BASENAME ) . '/languages/');
  }


  /**
   * Setup plugin constants
   *
   * @access private
   * @since  1.0
   * @return void
   */
  private function _define_constants() {
    global $wpdb;

    if ( ! isset( $wpdb->vimeography_pro_meta ) ) {
      $wpdb->vimeography_pro_meta = $wpdb->prefix . 'vimeography_pro_meta';
    }

    if ( ! defined('VIMEOGRAPHY_PRO_URL') )
      define( 'VIMEOGRAPHY_PRO_URL', plugin_dir_url(__FILE__) );

    if ( ! defined('VIMEOGRAPHY_PRO_PATH') )
      define( 'VIMEOGRAPHY_PRO_PATH', plugin_dir_path(__FILE__) );

    if ( ! defined('VIMEOGRAPHY_PRO_BASENAME') )
      define( 'VIMEOGRAPHY_PRO_BASENAME', plugin_basename( __FILE__ ) );

    if ( ! defined('VIMEOGRAPHY_PRO_VERSION') )
      define( 'VIMEOGRAPHY_PRO_VERSION', '1.0.1');

    if ( ! defined('VIMEOGRAPHY_PRO_CURRENT_PAGE') )
      define( 'VIMEOGRAPHY_PRO_CURRENT_PAGE', basename( $_SERVER['PHP_SELF'] ) );
  }


  /**
   * Include required files
   *
   * @since  1.0
   * @return void
   */
  private function _includes() {
    require_once VIMEOGRAPHY_PRO_PATH . 'lib/rewrite.php';
    require_once VIMEOGRAPHY_PRO_PATH . 'lib/loader.php';
    require_once VIMEOGRAPHY_PRO_PATH . 'lib/database.php';
    require_once VIMEOGRAPHY_PRO_PATH . 'lib/shortcode.php';
    require_once VIMEOGRAPHY_PRO_PATH . 'lib/ajax.php';
  }

	public function __construct() {
    add_action( 'admin_init',     array( $this, 'vimeography_pro_check_if_basic_active' ) );
    add_action( 'plugins_loaded', array( $this, 'vimeography_pro_load_addon_plugin' ) );
	}

  /**
   * Send the addons meta headers to the Vimeography updater
   * class as a registered addon.
   *
   * @return void
   */
  public function vimeography_pro_load_addon_plugin() {
    do_action('vimeography/load-addon-plugin', __FILE__);
  }


  /**
   * Prevent plugin activation if we're missing Vimeography
   *
   * @return void
   */
  public function vimeography_pro_check_if_basic_active() {
    // Deactivate Pro if Vimeography ain't around.
    if ( ! is_plugin_active('vimeography/vimeography.php' ) ) {
      deactivate_plugins( VIMEOGRAPHY_PRO_BASENAME );
      wp_die( sprintf( __('Vimeography Pro requires the basic version of Vimeography to be installed as well. <a href="%s">Back to WordPress admin</a>', 'vimeography-pro'), admin_url() ) );
    }
  }

}

/**
 * The main function responsible for returning the one true Vimeography_Pro
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $pro = Vimeography_Pro(); ?>
 *
 * @since 1.0
 * @return object The one true Vimeography_Pro Instance
 */
function Vimeography_Pro() {
  return Vimeography_Pro::instance();
}

// Get Vimeography Pro Running
Vimeography_Pro();