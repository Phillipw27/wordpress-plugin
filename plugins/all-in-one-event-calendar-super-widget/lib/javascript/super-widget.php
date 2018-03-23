<?php

/**
 * Handles Super Widget.
 *
 * @author     Time.ly Network Inc.
 * @since      2.0
 *
 * @package    AI1EC
 * @subpackage AI1EC.Javascript
 */
class Ai1ec_Javascript_Super_Widget extends Ai1ec_Base {

	/**
	 * @param array $data
	 * @return array
	 */
	public function add_js_translation( array $data ) {
		$data['set_calendar_page'] = __(
			'You must choose the Calendar page before using the Super Widget',
			AI1ECSW_PLUGIN_NAME
		);
		// Handle both versions of names for comptatibility.
		$data['javascript_widgets']['ai1ec-superwidget'] = array();
		$data['javascript_widgets']['ai1ec_superwidget'] = array();
		return $data;
	}

	/**
	 * Renders everything that's needed for the embedded widget.
	 */
	public function render_web_widget() {
		header( 'Content-Type: application/javascript' );
		// Aggressive caching to save future requests from the same client.
		$etag = '"' . md5( __FILE__ . AI1EC_VERSION ) . '"';
		header( 'ETag: ' . $etag );
		header(
			'Expires: ' . gmdate( 'D, d M Y H:i:s', time() + 31536000 ) . ' GMT'
		);
		header( 'Cache-Control: public, max-age=31536000' );

		if (
			empty( $_SERVER['HTTP_IF_NONE_MATCH'] ) ||
			$etag !== stripslashes( $_SERVER['HTTP_IF_NONE_MATCH'] ) ||
			(
				defined( 'AI1EC_DEBUG' ) &&
				AI1EC_DEBUG
			)
		) {

			$jscontroller   = $this->_registry->get( 'controller.javascript' );
			$css_controller = $this->_registry->get( 'css.frontend' );
			$require_main   = AI1EC_ADMIN_THEME_JS_PATH . DIRECTORY_SEPARATOR . 'require.js';
			$data_main      = AI1ECSW_PATH . '/public/js/main_widget.js';
			$translation    = $jscontroller->get_frontend_translation_data();
			$permalink      = get_permalink(
				$this->_registry->get( 'model.settings' )
					->get( 'calendar_page_id' )
			);
			// load the css to hardcode, saving a call
			$css_rules        = $css_controller->get_compiled_css();
			$css_rules = addslashes( $css_rules );
			$translation['calendar_url'] = $permalink;
			// Let extensions add their scripts.
			// look at Extended Views or Super Widget for examples
			$extension_urls = array();
			$extension_urls = apply_filters(
				'ai1ec_render_js',
				$extension_urls,
				'main_widget.js'
			);

			$translation['extension_urls'] = $extension_urls;
			// the single event page js is loaded dinamically.
			$translation['event_page'] = array(
					'id' => 'ai1ec_event',
					'url' => AI1EC_URL . '/public/js/pages/event.js',
			);
			$translation_module = $jscontroller->create_require_js_module(
				Ai1ec_Javascript_Controller::FRONTEND_CONFIG_MODULE,
				$translation
			);
			// get requirejs
			$require = file_get_contents( $require_main );
			$main_widget = file_get_contents( $data_main );
			$require_config = $jscontroller->create_require_js_config_object();
			$config         = $jscontroller->create_require_js_module(
				'ai1ec_config',
				$jscontroller->get_translation_data()
			);
			// get jquery
			$jquery = $jscontroller->get_jquery_version_based_on_browser(
				isset( $_SERVER['HTTP_USER_AGENT'] )
					? $_SERVER['HTTP_USER_AGENT']
					: ''
			);
			$calendar = $jscontroller->get_module(
				'scripts/calendar.js'
			);

			$domready = $jscontroller->get_module(
				'domReady.js'
			);
			$frontend = $jscontroller->get_module(
				'scripts/common_scripts/frontend/common_frontend.js'
			);

			// compress data if possible
			$compatibility_ob = $this->_registry->get( 'compatibility.ob' );
			$js = <<<JS
			/******** Called once Require.js has loaded ******/

			(function() {

				var timely_css = document.createElement( 'style' );
				timely_css.innerHTML = '$css_rules';
				( document.getElementsByTagName( "head" )[0] || document.documentElement ).appendChild( timely_css );
				// bring in requires
				$require
				// make timely global
				window.timely = timely;
				$require_config
				// Load other modules
				$translation_module
				$config
				$jquery
				$frontend

				$calendar
				// start up the widget
				$main_widget
			})(); // We call our anonymous function immediately
JS;
			$compatibility_ob->gzip_if_possible( $js );
		} else {
			// Not modified!
			status_header( 304 );
		}
		exit( 0 );
	}

	/**
	 * Adds the email notifications files if the page is the calendar feeds one.
	 *
	 * @param string $page Page identifier.
	 *
	 * @return string Page identifier.
	 */
	public function add_backend_js( $page ) {
		$page_id = 'all-in-one-event-calendar-super-widget';
		if (
			isset( $_GET['page'] ) &&
			$page_id === $_GET['page']
		) {
			$page = 'admin_settings.js';
		}
		return $page;
	}

}
