<?php

/**
 * Temporary SW class
 *
 * @author     Time.ly Network Inc.
 * @since      2.0
 *
 * @package    AI1ECSW
 * @subpackage AI1ECSW.Controller
 */
class Ai1ec_Super_Widget {

	/**
	 * @return string
	 */
	public function get_name() {
		return 'Full Calendar';
	}

	/**
	 * @return string
	 */
	public function get_icon() {
		return 'ai1ec-fa ai1ec-fa-calendar';
	}

	/**
	 * @return array
	 */
	public function get_configurable_for_widget_creation() {
		$settings = array(
			'no_navigation' => array(
				'renderer' => array(
					'class'   => 'select',
					'label'   => __(
						'Navigation bar',
						AI1ECSW_PLUGIN_NAME
					),
					'options' => array(
						array(
							'text'  => __(
								'With Calendar',
								AI1ECSW_PLUGIN_NAME
							),
							'value' => ''
						),
						array(
							'text'  => __(
								'No navigation bar',
								AI1ECSW_PLUGIN_NAME
							),
							'value' => 'true'
						),
					),
				),
				'value' => 'calendar',
			),
			'display_filters' => array(
				'renderer' => array(
					'class' => 'select',
					'label' => __(
						'Filter bar',
						AI1ECSW_PLUGIN_NAME
					),
					'options' => array(
						array(
							'text'  => __(
								'With Calendar',
								AI1ECSW_PLUGIN_NAME
							),
							'value' => 'true'
						),
						array(
							'text'  => __(
								'No filter bar',
								AI1ECSW_PLUGIN_NAME
							),
							'value' => ''
						),
					),
				),
				'value' => '',
			),
			'action' => array(
				'renderer' => array(
					'class' => 'select',
					'label' => Ai1ec_I18n::__(
						'Display type'
					),
					'options' => array(
						array(
							'text'  => __( 'Default', AI1ECSW_PLUGIN_NAME ),
							'value' => ''
						),
						array(
							'text'  => __( 'Agenda', AI1ECSW_PLUGIN_NAME ),
							'value' => 'agenda'
						),
						array(
							'text'  => __( 'Day', AI1ECSW_PLUGIN_NAME ),
							'value' => 'oneday'
						),
						array(
							'text'  => __( 'Month', AI1ECSW_PLUGIN_NAME ),
							'value' => 'month'
						),
						array(
							'text'  => __( 'Week', AI1ECSW_PLUGIN_NAME ),
							'value' => 'week'
						),
					),
				),
				'value' => '',
			),
			'events_limit' => array(
				'renderer' => array(
					'class' => 'input',
					'type'  => 'number',
					'label' => __(
						'Events per page',
						AI1ECSW_PLUGIN_NAME
					),
				),
				'value' => '',
			),
			'tags_categories' => array(
				'renderer' => array(
					'class' => 'tags-categories',
					'label' => __(
						'Preselected calendar filters',
						AI1ECSW_PLUGIN_NAME
					),
					'help'  => __(
						'To clear, hold &#8984;/<abbr class="initialism">CTRL</abbr> and click selection.',
						AI1ECSW_PLUGIN_NAME
					)
				),
				'value' => array(
					'categories' => array(),
					'tags'       => array(),
				),
			),
		);
		$extra_settings = apply_filters(
			'ai1ec_widget_creator_superwidget_extra_fields',
			array()
		);
		$settings = array_merge( $settings, $extra_settings );
		return $settings;
	}

	/**
	 * Add the SW
	 *
	 * @param array $widgets
	 * @return array
	 */
	public function add_widget( array $widgets ) {
		$widgets['ai1ec_superwidget'] = 'view.super-widget';
		return $widgets;
	}

	/**
	 * Checks and returns widget requirements.
	 *
	 * @return string
	 */
	public function check_requirements() {
		return null;
	}
}
