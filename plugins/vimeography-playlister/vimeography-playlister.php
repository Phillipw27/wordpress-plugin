<?php
/*
Plugin Name: Vimeography Theme: Playlister
Plugin URI: http://www.vimeography.com/
Theme Name: Playlister
Theme URI: Http://vimeography.com/themes/playlister
Version: 1.0.2
Description: showcases a stream of videos meant to be played back to back.
Author: Dave Kiss
Author URI: http://vimeography.com
Copyright: 2017
*/

if ( ! class_exists('Vimeography_Themes_Playlister') ) {
  class Vimeography_Themes_Playlister {

    /**
     * The current version of this Vimeography theme.
     *
     * Make sure to specify it here as well as above
     * in the header metadata and in the readme.txt
     * file, located in the root of the plugin directory.
     *
     * @var string
     */
    public $version = '1.0.2';

    /**
     * The constructor is used to load the plugin
     * when the Wordpress `plugins_loaded` hook is fired.
     *
     * Reports in to the Vimeography plugin to
     * declare that this theme plugin is installed and activated.
     */
    public function __construct() {
      do_action('vimeography/load-theme', __FILE__);
    }

    /**
     * The __set magic function creates a variable
     * for anything passed to the Vimeography theme and
     * makes that variable accessible in the mustache template.
     *
     * @param string $name  The key to assign to the property.
     * @param mixed  $value The value of the property.
     */
    public function __set($name, $value) {
      $this->$name = $value;
    }

    /**
     * Loads any CSS and Javascript dependencies that this
     * Vimeography theme plugin relies on. This is called
     * from the Vimeography_Renderer class.
     *
     * Uses the standard `wp_register_script()` and
     * `wp_enqueue_script()` functions to load the proper scripts.
     *
     * For scripts and styles that are pre-installed with the
     * Vimeography plugin, use `VIMEOGRAPHY_ASSETS_URL` as the
     * root location, then add the relative path to the JS or CSS file.
     *
     *   wp_register_script('vimeography-utilities', VIMEOGRAPHY_ASSETS_URL.'js/utilities.js', array('jquery'));
     *
     * For scripts and styles that are included in this Vimeography
     * theme plugin's `assets` folder, define the root and relative path
     *
     *   wp_register_style('vimeography-playlister', plugins_url('assets/css/vimeography-playlister.css', __FILE__));
     *
     */
    public static function load_scripts() {
      // Deregister common scripts and styles here
      wp_deregister_script('fitvids');

      // Dequeue common scripts and styles here
      wp_dequeue_script('fitvids');
      /* inject:dequeue_scripts */

      // Register our shared Vimeography javascripts
      wp_register_script('fitvids', VIMEOGRAPHY_ASSETS_URL.'js/plugins/jquery.fitvids.js', array('jquery'));
      wp_register_script('spin', VIMEOGRAPHY_ASSETS_URL.'js/plugins/spin.min.js', array('jquery'));
      wp_register_script('jquery-spin', VIMEOGRAPHY_ASSETS_URL.'js/plugins/jquery.spin.js', array('jquery', 'spin'));
      wp_register_script('froogaloop', VIMEOGRAPHY_ASSETS_URL.'js/plugins/froogaloop2.min.js');
      wp_register_script('scrollto', VIMEOGRAPHY_ASSETS_URL.'js/plugins/jquery.scrollTo.min.js');
      wp_register_script('vimeography-utilities', VIMEOGRAPHY_ASSETS_URL.'js/vimeography-utilities.js', array('jquery', 'froogaloop'));
      wp_register_script('vimeography-pagination', VIMEOGRAPHY_ASSETS_URL.'js/vimeography-pagination.js', array('jquery'));
      /* inject:register_scripts */

      // Register our shared Vimeography stylesheets
      wp_register_style('vimeography-common', VIMEOGRAPHY_ASSETS_URL.'css/vimeography-common.css');
      /* inject:register_styles */

      // Register our Vimeography theme-specific stylesheets
      wp_register_style('playlister', plugins_url('assets/css/vimeography-playlister.css', __FILE__));

      // Register any of your Vimeography theme-specific javascripts here
      // Use minified libraries if SCRIPT_DEBUG is turned off
      $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
      /* inject:register_theme_script */
      wp_register_script('vimeography-playlister', plugins_url('assets/js/vimeography-playlister' . $suffix . '.js', __FILE__), array('jquery', 'vimeography-utilities', 'vimeography-pagination', 'scrollto') );


      // Enqueue all of our assets
      wp_enqueue_style('vimeography-common');
      /* inject:enqueue_styles */
      wp_enqueue_style('playlister');
      wp_enqueue_script('fitvids');
      wp_enqueue_script('spin');
      wp_enqueue_script('jquery-spin');
      /* inject:enqueue_scripts */
      wp_enqueue_script("scrollto");

      wp_enqueue_script('froogaloop');
      wp_enqueue_script('vimeography-utilities');
      wp_enqueue_script('vimeography-pagination');
      wp_enqueue_script('vimeography-playlister');
    }

    /**
     * The last chance to format the Vimeo data
     * before it is sent to the template.
     *
     * All of the available Vimeo data is accessible in the
     * `$this->data` property. You should most likely apply
     * the common Vimeography formatting to the data before you
     * use it.
     *
     *   $helpers->apply_common_formatting($this->data);
     *
     * @return array Vimeo video data.
     */
    public function videos() {
      // optional helpers
      require_once VIMEOGRAPHY_PATH . 'lib/helpers.php';
      $helpers = new Vimeography_Helpers;

      $items = array();

      foreach ($this->data as $video) {
        $video->short_description = $helpers->truncate($video->description, 110);
        $items[] = $video;
      }

      $items = $helpers->apply_common_formatting($items);
      return $items;
    }

    public function featured() {
      // optional helpers
      require_once(VIMEOGRAPHY_PATH .'lib/helpers.php');
      $helpers = new Vimeography_Helpers;

      $this->featured->oembed = $helpers->get_featured_embed($this->featured->link);

      return $this->featured;
    }

    /**
     * If your Vimeography theme is built to support
     * pagination, it's probably a good idea to make the
     * total pages of Vimeo videos available to the template.
     *
     * @return int Number of pages of video data
     */
    public function total_pages() {
      return ceil($this->total / $this->per_page);
    }

  }
}

function vimeography_themes_playlister() {
  if ( ! class_exists( 'Vimeography', false ) ) {
    return;
  }

  new Vimeography_Themes_Playlister;
}

// Get this theme loaded at a lower priority than the Dev Bundle
add_action( 'plugins_loaded', 'vimeography_themes_playlister', 5 );