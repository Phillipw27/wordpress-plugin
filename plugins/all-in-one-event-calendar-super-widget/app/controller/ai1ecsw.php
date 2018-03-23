<?php

/**
 * Interactive Frontend extension front controller.
 *
 * @author     Time.ly Network Inc.
 * @since      2.0
 *
 * @package    AI1ECSW
 * @subpackage AI1ECSW.Controller
 */
class Ai1ec_Controller_Ai1ecsw extends Ai1ec_Base_License_Controller {


	/* (non-PHPdoc)
	 * @see Ai1ec_Base_Extension_Controller::get_name()
	 */
	public function get_name() {
		return 'SuperWidget';
	}

	/* (non-PHPdoc)
	 * @see Ai1ec_Base_Extension_Controller::get_machine_name()
	 */
	public function get_machine_name() {
		return 'super_widget';
	}

	/* (non-PHPdoc)
	 * @see Ai1ec_Base_Extension_Controller::get_version()
	 */
	public function get_version() {
		return AI1ECSW_VERSION;
	}

	/* (non-PHPdoc)
	 * @see Ai1ec_Licence_Controller::get_file()
	 */
	public function get_file() {
		return AI1ECSW_FILE;
	}

	/* (non-PHPdoc)
	 * @see Ai1ec_Base_License_Controller::get_license_label()
	 */
	public function get_license_label() {
		return 'Super Widget License Key';
	}

	/* (non-PHPdoc)
	 * @see Ai1ec_Base_License_Controller::add_tabs()
	 */
	public function add_tabs( array $tabs ) {
		$tabs = parent::add_tabs( $tabs );
		$tabs['extensions']['items']['super_widget'] = __( 'Super Widget', AI1ECSW_PLUGIN_NAME );
		return $tabs;
	}

	public function get_settings() {
		return $this->_get_settings();
	}

	/* (non-PHPdoc)
	 * @see Ai1ec_Base_Extension_Controller::minimum_core_required()
	 */
	public function minimum_core_required() {
		return '2.2.0';
	}

	/* (non-PHPdoc)
	 * @see Ai1ec_Base_Extension_Controller::_set_settings()
	 */
	protected function _get_settings() {
		return array(
			'superwidget' => array(
				'type' => 'deprecated',
				'version'  => AI1ECSW_VERSION,
				'renderer' => array(
					'class' => 'html-sw',
					'tab'   => 'extensions',
					'item'  => 'super_widget',
				),
				'value'   => null,
			),
			'ajaxify_events_in_web_widget' => array(
				'type' => 'deprecated',
				'renderer' => array(
					'class' => 'checkbox',
					'tab'   => 'extensions',
					'item'  => 'super_widget',
					'label' => __( '<strong>Use AJAX</strong> to load events when using the Super Widget', AI1ECSW_PLUGIN_NAME )
				),
				'value'  => true,
			),
		);
	}

	/* (non-PHPdoc)
	 * @see Ai1ec_Base_Extension_Controller::_register_actions()
	 */
	protected function _register_actions( Ai1ec_Event_Dispatcher $dispatcher ) {
		// Add hook to render the JS for the embedded widget.
/*
		if ( isset( $_GET['ai1ec_super_widget'] ) ) {
			add_filter( 'ai1ec_is_ajax', '__return_true' );
			$dispatcher->register_action(
				'init',
				array( 'javascript.super-widget', 'render_web_widget' ),
				1
			);
		}
*/
		$dispatcher->register_filter(
			'ai1ec_js_translations',
			array( 'javascript.super-widget', 'add_js_translation' )
		);
		$dispatcher->register_filter(
			'ai1ec_widget_creators_widgets',
			array( 'view.super-widget', 'add_widget' )
		);
		$dispatcher->register_filter(
			'ai1ec_handle_saving_superwidget_default_tags_categories',
			array( 'model.settingssw', 'handle_saving_superwidget_default_tags_categories' ),
			10,
			3
		);
		$dispatcher->register_filter(
			'ai1ec_before_save_settings',
			array( 'model.settingssw', 'ai1ec_before_save_settings' )
		);
	}
}
