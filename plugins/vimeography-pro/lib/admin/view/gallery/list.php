<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class Vimeography_Pro_Gallery_List extends Vimeography_Gallery_List {

  /**
   * [__construct description]
   */
  public function __construct() {
    add_action('vimeography-pro/duplicate-gallery', array($this, 'duplicate_pro_gallery'), 10, 2);
    add_action('vimeography-pro/delete-gallery', array($this, 'delete_pro_gallery'));
    parent::__construct();
  }

  /**
   * Creates a copy of the given gallery id settings.
   *
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function duplicate_pro_gallery($old_id, $new_id) {
    try {
      global $wpdb;

      $duplicate = $wpdb->get_results('
        SELECT *
        FROM ' . $wpdb->vimeography_pro_meta . ' AS pro
        WHERE pro.gallery_id = ' . $old_id . '
        LIMIT 1;'
      );

      $result = $wpdb->insert(
        $wpdb->vimeography_pro_meta,
        array(
          'gallery_id' => $new_id,
          'per_page'   => $duplicate[0]->per_page,
          'sort'       => $duplicate[0]->sort,
          'direction'  => $duplicate[0]->direction,
          'playlist'   => $duplicate[0]->playlist,
          'allow_downloads'   => $duplicate[0]->allow_downloads
        )
      );

      if ( $result === FALSE ) {
        throw new Exception( __('Your gallery could not be duplicated.', 'vimeography-pro') );
      }
    } catch (Exception $e) {
      $this->messages[] = array('type' => 'error', 'heading' => __('Ruh Roh.'), 'message' => $e->getMessage());
    }
  }

  /**
   * Deletes the gallery of the given id in the database.
   *
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function delete_pro_gallery($id) {
    try {
      global $wpdb;
      $result = $wpdb->query('
        DELETE pro
        FROM ' . $wpdb->vimeography_pro_meta . ' pro
        WHERE pro.gallery_id = ' . $id . ';'
      );

      if ( $result === FALSE ) {
        throw new Exception( __('Your gallery could not be deleted.', 'vimeography-pro') );
      }

    } catch (Exception $e) {
      $this->messages[] = array('type' => 'error', 'heading' => __('Ruh Roh.'), 'message' => $e->getMessage());
    }
  }

}