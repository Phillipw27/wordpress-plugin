<?php

/**
 * Super Widget settings.
 *
 * @author     Time.ly Network Inc.
 * @since      1.0
 *
 * @package    AI1ECSW
 * @subpackage AI1ECSW.Model
 */
class Ai1ec_Model_Settingssw extends Ai1ec_Base {

	
	/**
	 * Handle saving of super widgets default-categories settings
	 * 
	 * @param array $value
	 * @param array $data
	 * 
	 * @return array 
	 */
	public function handle_saving_superwidget_default_tags_categories( $value, $data ) {
		return array(
			'tags' => isset( $_POST['superwidget_default_tags_categories_default_tags'] ) ?
				$_POST['superwidget_default_tags_categories_default_tags'] :
				array(),
			'categories' => isset( $_POST['superwidget_default_tags_categories_default_categories'] ) ?
				$_POST['superwidget_default_tags_categories_default_categories'] :
				array(),
		);
	}
	
	/**
	 * Adds super widgets default-categories to settings save
	 * 
	 * @param array $post
	 * 
	 * @return array
	 */
	public function ai1ec_before_save_settings( $post ) {
		$post['superwidget_default_tags_categories'] = true;
		return $post;
	}
}