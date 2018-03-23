<?php

class BWGViewBlog_style {
  ////////////////////////////////////////////////////////////////////////////////////////
  // Events                                                                             //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Constants                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Variables                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  private $model;


  ////////////////////////////////////////////////////////////////////////////////////////
  // Constructor & Destructor                                                           //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function __construct($model) {
    $this->model = $model;
  }
  ////////////////////////////////////////////////////////////////////////////////////////
  // Public Methods                                                                     //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function display($params, $from_shortcode = 0, $bwg = 0) {
    global $wp;
    $current_url = $wp->query_string;
    global $WD_BWG_UPLOAD_DIR;
    require_once(WD_BWG_DIR . '/framework/WDWLibrary.php');
    $theme_row = $this->model->get_theme_row_data($params['theme_id']);
    if (!$theme_row) {
      echo WDWLibrary::message(__('There is no theme selected or the theme was deleted.', 'bwg'), 'error');
      return;
    }
    if (!isset($params['order_by'])) {
      $order_by = 'asc';
    }
    else {
      $order_by = $params['order_by'];
    }
    if (!isset($params['popup_enable_pinterest'])) {
      $params['popup_enable_pinterest'] = 0;
    }
    if (!isset($params['popup_enable_tumblr'])) {
      $params['popup_enable_tumblr'] = 0;
    }
    if (!isset($params['show_search_box'])) {
      $params['show_search_box'] = 0;
    }
    if (!isset($params['search_box_width'])) {
      $params['search_box_width'] = 180;
    }
    if (!isset($params['popup_enable_info'])) {
      $params['popup_enable_info'] = 1;
    }
    if (!isset($params['popup_info_always_show'])) {
      $params['popup_info_always_show'] = 0;
    }
	if (!isset($params['popup_info_full_width'])) {
      $params['popup_info_full_width'] = 0;
    }
    if (!isset($params['popup_enable_rate'])) {
      $params['popup_enable_rate'] = 0;
    }
    if (!isset($params['thumb_click_action']) || $params['thumb_click_action'] == 'undefined') {
      $params['thumb_click_action'] = 'open_lightbox';
    }
    if (!isset($params['thumb_link_target'])) {
      $params['thumb_link_target'] = 1;
    }
    if (!isset($params['popup_hit_counter'])) {
      $params['popup_hit_counter'] = 0;
    }
    if (isset($_POST['sortImagesByValue_' . $bwg])) {
			$sort_by = esc_html($_POST['sortImagesByValue_' . $bwg]);
			if ($sort_by == 'random') {
				$params['sort_by'] = 'RAND()';
			}
			else if ($sort_by == 'default')  {
				$params['sort_by'] = $params['sort_by'];
			}
			else {
				$params['sort_by'] = $sort_by;
			}
		}
    if (!isset($params['show_sort_images'])) {
      $params['show_sort_images'] = 0;
    }
    $gallery_row = $this->model->get_gallery_row_data($params['gallery_id']);
    if (!$gallery_row) {
      echo WDWLibrary::message(__('There is no gallery selected or the gallery was deleted.', 'bwg'), 'error');
      return;
    }
    $image_rows = $this->model->get_image_rows_data($params['gallery_id'], $params['blog_style_images_per_page'], $params['sort_by'], $order_by,  $bwg);
    $images_count = count($image_rows);
    if (!$image_rows) {
      echo WDWLibrary::message(__('There are no images in this gallery.', 'bwg'), 'error');
    }
    if ($params['blog_style_enable_page'] && $params['blog_style_images_per_page']) {
      $page_nav = $this->model->page_nav($params['gallery_id'], $params['blog_style_images_per_page'], $bwg);
    }
    $rgb_page_nav_font_color = WDWLibrary::spider_hex2rgb($theme_row->page_nav_font_color);
    $bwg_blog_style_image = WDWLibrary::spider_hex2rgb($theme_row->blog_style_bg_color);
    $blog_style_share_buttons_bg_color = WDWLibrary::spider_hex2rgb($theme_row->blog_style_share_buttons_bg_color);
    $option_row = $this->model->get_option_row_data();
    $image_right_click = $option_row->image_right_click;
    $image_title = $params['blog_style_title_enable'];
    if (!isset($params['popup_fullscreen'])) {
      $params['popup_fullscreen'] = 0;
    }
    if (!isset($params['popup_autoplay'])) {
      $params['popup_autoplay'] = 0;
    }
    $params_array = array(
      'action' => 'GalleryBox',
      'current_view' => $bwg,
      'gallery_id' => $params['gallery_id'],
      'theme_id' => $params['theme_id'],
      'open_with_fullscreen' => $params['popup_fullscreen'],
      'open_with_autoplay' => $params['popup_autoplay'],
      'image_width' => $params['popup_width'],
      'image_height' => $params['popup_height'],
      'image_effect' => $params['popup_effect'],
      'wd_sor' => $params['sort_by'],
      'wd_ord' => $order_by,
      'enable_image_filmstrip' => $params['popup_enable_filmstrip'],
      'image_filmstrip_height' => $params['popup_filmstrip_height'],
      'enable_image_ctrl_btn' => $params['popup_enable_ctrl_btn'],
      'enable_image_fullscreen' => $params['popup_enable_fullscreen'],
      'popup_enable_info' => $params['popup_enable_info'],
      'popup_info_always_show' => $params['popup_info_always_show'],
      'popup_info_full_width' => $params['popup_info_full_width'],
      'popup_hit_counter' => $params['popup_hit_counter'],
      'popup_enable_rate' => $params['popup_enable_rate'],
      'slideshow_interval' => $params['popup_interval'],
      'enable_comment_social' => $params['popup_enable_comment'],
      'enable_image_facebook' => $params['popup_enable_facebook'],
      'enable_image_twitter' => $params['popup_enable_twitter'],
      'enable_image_google' => $params['popup_enable_google'],
      'enable_image_pinterest' => $params['popup_enable_pinterest'],
      'enable_image_tumblr' => $params['popup_enable_tumblr'],
      'watermark_type' => $params['watermark_type'],
      'current_url' => $current_url
    );	
    if ($params['watermark_type'] == 'none') {
      $show_watermark = FALSE;
    }
    if ($params['watermark_type'] != 'none') {
      $params_array['watermark_link'] = $params['watermark_link'];
      $params_array['watermark_opacity'] = $params['watermark_opacity'];
      $params_array['watermark_position'] =(($params['watermark_position'] != 'undefined') ? $params['watermark_position'] : 'top-center');
			$position = explode('-', $params_array['watermark_position']);
			$vertical_align = $position[0];
			$text_align = $position[1];
    }
    if ($params['watermark_type'] == 'text') {
      $show_watermark = TRUE;
      $watermark_text_image = TRUE;
      $params_array['watermark_text'] = $params['watermark_text'];
      $params_array['watermark_font_size'] = $params['watermark_font_size'];
      $params_array['watermark_font'] = $params['watermark_font'];
      $params_array['watermark_color'] = $params['watermark_color'];
			$params_array['watermark_width'] = '';
			$watermark_image_or_text = $params_array['watermark_text'];
			$watermark_a = 'bwg_watermark_text_' . $bwg;
			$watermark_div = 'class="bwg_blog_style_watermark_text_' . $bwg . '"';
    }
    elseif ($params['watermark_type'] == 'image') {
      $show_watermark = TRUE;
      $watermark_text_image = FALSE;
      $params_array['watermark_url'] = $params['watermark_url'];
      $params_array['watermark_width'] = $params['watermark_width'];
      $params_array['watermark_height'] = $params['watermark_height'];
			$watermark_image_or_text = '<img class="bwg_blog_style_watermark_img_' . $bwg . '" src="' . $params_array['watermark_url'] . '" >';
			$watermark_a = '';
			$watermark_div = 'class="bwg_blog_style_watermark_' . $bwg . '"';
    }
    $params_array_hash = $params_array;
    ?>
    <style>
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .blog_style_images_conteiner_<?php echo $bwg; ?>{
				background-color: rgba(0, 0, 0, 0);
				text-align: center;
				width: 100%;
				position: relative;
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .blog_style_images_<?php echo $bwg; ?> {
				display: inline-block;
				-moz-box-sizing: border-box;
				box-sizing: border-box;
				font-size: 0;
				text-align: center;
				max-width: 100%;
				width: <?php echo $params['blog_style_width']; ?>px;
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .blog_style_image_buttons_conteiner_<?php echo $bwg; ?> {
				text-align: <?php echo $theme_row->blog_style_align; ?>;
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .blog_style_image_buttons_<?php echo $bwg; ?> {
				text-align: center;
				/*display: inline-block;*/
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_blog_style_image_<?php echo $bwg; ?> {
        background-color: rgba(<?php echo $bwg_blog_style_image['red']; ?>, <?php echo $bwg_blog_style_image['green']; ?>, <?php echo $bwg_blog_style_image['blue']; ?>, <?php echo number_format($theme_row->blog_style_transparent / 100, 2, ".", ""); ?>);
				text-align: center;
				/*display: inline-block;*/
				vertical-align: middle;
				margin: <?php echo $theme_row->blog_style_margin; ?>;
				padding: <?php echo $theme_row->blog_style_padding; ?>;
				border-radius: <?php echo $theme_row->blog_style_border_radius; ?>;
				border: <?php echo $theme_row->blog_style_border_width; ?>px <?php echo $theme_row->blog_style_border_style; ?> #<?php echo $theme_row->blog_style_border_color; ?>;
				box-shadow: <?php echo $theme_row->blog_style_box_shadow; ?>;
				position: relative;
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_image_alt_<?php echo $bwg; ?> {
				display: table-cell;
				width: 50%;
				text-align: <?php  if (!(($params['popup_enable_comment'] or $params['popup_enable_facebook'] or $params['popup_enable_twitter'] or $params['popup_enable_google']) and ($params['popup_enable_ctrl_btn'])) and ($params['blog_style_title_enable']) ) echo $theme_row->blog_style_share_buttons_align; else echo "left"; ?>;
				font-size: <?php echo $theme_row->blog_style_img_font_size; ?>px;
				font-family: <?php echo $theme_row->blog_style_img_font_family; ?>;
				color: #<?php echo $theme_row->blog_style_img_font_color; ?>;
				padding-left: 8px;
        word-wrap: break-word;
        word-break: break-word;
        vertical-align: middle;
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_blog_style_img_<?php echo $bwg; ?> {
        padding: 0 !important;
        max-width: 100% !important;
        height: inherit !important;
        width: 100%;
      }
      /*pagination styles*/
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .tablenav-pages_<?php echo $bwg; ?> {
				text-align: <?php echo $theme_row->page_nav_align; ?>;
				font-size: <?php echo $theme_row->page_nav_font_size; ?>px;
				font-family: <?php echo $theme_row->page_nav_font_style; ?>;
				font-weight: <?php echo $theme_row->page_nav_font_weight; ?>;
				color: #<?php echo $theme_row->page_nav_font_color; ?>;
				margin: 6px 0 4px;
				display: block;
				height: 30px;
				line-height: 30px;
      }
      @media only screen and (max-width : 320px) {
				#bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .displaying-num_<?php echo $bwg; ?> {
				  display: none;
				}
        #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_image_alt_<?php echo $bwg; ?>{
				  display: none;
				}
        <?php
        if ($show_watermark && $watermark_text_image) { ?>
				#bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_watermark_text_<?php echo $bwg; ?>,
        #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_watermark_text_<?php echo $bwg; ?>:hover {
				  font-size:10px !important;
				  text-decoration: none;
				  margin: 4px;
				  font-family: <?php echo $params_array['watermark_font']; ?>;
				  color: #<?php echo $params_array['watermark_color']; ?> !important;
				  opacity: <?php echo number_format($params_array['watermark_opacity'] / 100, 2, ".", ""); ?>;
          filter: Alpha(opacity=<?php echo $params_array['watermark_opacity']; ?>);
          text-decoration: none;
				  position: relative;
				  z-index: 10141;
				}
        <?php } ?>
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .displaying-num_<?php echo $bwg; ?> {
				font-size: <?php echo $theme_row->page_nav_font_size; ?>px;
				font-family: <?php echo $theme_row->page_nav_font_style; ?>;
				font-weight: <?php echo $theme_row->page_nav_font_weight; ?>;
				color: #<?php echo $theme_row->page_nav_font_color; ?>;
				margin-right: 10px;
				vertical-align: middle;
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .paging-input_<?php echo $bwg; ?> {
				font-size: <?php echo $theme_row->page_nav_font_size; ?>px;
				font-family: <?php echo $theme_row->page_nav_font_style; ?>;
				font-weight: <?php echo $theme_row->page_nav_font_weight; ?>;
				color: #<?php echo $theme_row->page_nav_font_color; ?>;
				vertical-align: middle;
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .tablenav-pages_<?php echo $bwg; ?> a.disabled,
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .tablenav-pages_<?php echo $bwg; ?> a.disabled:hover,
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .tablenav-pages_<?php echo $bwg; ?> a.disabled:focus {
				cursor: default;
				color: rgba(<?php echo $rgb_page_nav_font_color['red']; ?>, <?php echo $rgb_page_nav_font_color['green']; ?>, <?php echo $rgb_page_nav_font_color['blue']; ?>, 0.5);
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .tablenav-pages_<?php echo $bwg; ?> a {
				cursor: pointer;
				font-size: <?php echo $theme_row->page_nav_font_size; ?>px;
				font-family: <?php echo $theme_row->page_nav_font_style; ?>;
				font-weight: <?php echo $theme_row->page_nav_font_weight; ?>;
				color: #<?php echo $theme_row->page_nav_font_color; ?>;
				text-decoration: none;
				padding: <?php echo $theme_row->page_nav_padding; ?>;
				margin: <?php echo $theme_row->page_nav_margin; ?>;
				border-radius: <?php echo $theme_row->page_nav_border_radius; ?>;
				border-style: <?php echo $theme_row->page_nav_border_style; ?>;
				border-width: <?php echo $theme_row->page_nav_border_width; ?>px;
				border-color: #<?php echo $theme_row->page_nav_border_color; ?>;
				background-color: #<?php echo $theme_row->page_nav_button_bg_color; ?>;
				opacity: <?php echo number_format($theme_row->page_nav_button_bg_transparent / 100, 2, ".", ""); ?>;
				filter: Alpha(opacity=<?php echo $theme_row->page_nav_button_bg_transparent; ?>);
				box-shadow: <?php echo $theme_row->page_nav_box_shadow; ?>;
				<?php echo ($theme_row->page_nav_button_transition ) ? 'transition: all 0.3s ease 0s;-webkit-transition: all 0.3s ease 0s;' : ''; ?>
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> #spider_popup_overlay_<?php echo $bwg; ?> {
				background-color: #<?php echo $theme_row->lightbox_overlay_bg_color; ?>;
        opacity: <?php echo number_format($theme_row->lightbox_overlay_bg_transparent / 100, 2, ".", ""); ?>;
        filter: Alpha(opacity=<?php echo $theme_row->lightbox_overlay_bg_transparent; ?>);
      }
      /*Share button styles*/
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_blog_style_share_buttons_image_alt<?php echo $bwg; ?> {
				display: table;
				clear: both;
				margin: <?php echo $theme_row->blog_style_share_buttons_margin; ?>;
				text-align: center;
				width: 100%;
				border:<?php echo $theme_row->blog_style_share_buttons_border_width; ?>px <?php echo $theme_row->blog_style_share_buttons_border_style; ?> #<?php echo $theme_row->blog_style_share_buttons_border_color; ?>;
        border-radius: <?php echo $theme_row->blog_style_share_buttons_border_radius; ?>;
				background-color: rgba(<?php echo $blog_style_share_buttons_bg_color['red']; ?>, <?php echo $blog_style_share_buttons_bg_color['green']; ?>, <?php echo $blog_style_share_buttons_bg_color['blue']; ?>, <?php echo number_format($theme_row->blog_style_share_buttons_bg_transparent / 100, 2, ".", ""); ?>);
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_blog_style_share_buttons_<?php echo $bwg; ?> {
        display: table-cell;
        text-align: <?php if ((($params['popup_enable_comment'] or $params['popup_enable_facebook'] or $params['popup_enable_twitter'] or $params['popup_enable_google']) and ($params['popup_enable_ctrl_btn'])) and (!($params['blog_style_title_enable'])) ) echo $theme_row->blog_style_share_buttons_align; else echo "right"; ?>;
        width: 50%;
        color: #<?php echo $theme_row->blog_style_share_buttons_color; ?>;
				font-size: <?php echo $theme_row->blog_style_share_buttons_font_size; ?>px;
        vertical-align:middle;
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_blog_style_share_buttons_<?php echo $bwg; ?> a,
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_blog_style_share_buttons_<?php echo $bwg; ?> a:hover {
        color: #<?php echo $theme_row->blog_style_share_buttons_color; ?>;
				font-size: <?php echo $theme_row->blog_style_share_buttons_font_size; ?>px;
        margin: 0 5px;
        text-decoration: none;
        vertical-align: middle;
        font-family: none;
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .fa {
        vertical-align: baseline;
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_facebook:hover {
				color: #3B5998;
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_twitter:hover {
				color: #4099FB;
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_google:hover {
				color: #DD4B39;
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_pinterest:hover {
        color: #cb2027;
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_tumblr:hover {
        color: #2F5070;
      }
      /*watermark*/
      <?php
        if ($show_watermark && $watermark_text_image) { ?>
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_watermark_text_<?php echo $bwg; ?>,
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_watermark_text_<?php echo $bwg; ?>:hover {
				text-decoration: none;
				margin: 4px;
				font-size: <?php echo $params_array['watermark_font_size']; ?>px;
				font-family: <?php echo $params_array['watermark_font']; ?>;
				color: #<?php echo $params_array['watermark_color']; ?> !important;
				opacity: <?php echo number_format($params_array['watermark_opacity'] / 100, 2, ".", ""); ?>;
				filter: Alpha(opacity=<?php echo $params_array['watermark_opacity']; ?>);
				position: relative;
				z-index: 10141;
      }
      <?php } ?>
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_blog_style_image_contain_<?php echo $bwg; ?>{
				position: absolute;
				text-align: center;
				vertical-align: middle;
				width: 100%;
				height: 100%;
				cursor: pointer;
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_blog_style_watermark_contain_<?php echo $bwg; ?>{
        display: table;
				vertical-align: middle;
				width: 100%;
				height: 100%;
      }	 
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_blog_style_watermark_cont_<?php echo $bwg; ?>{
        display: table-cell;
				text-align: <?php echo $text_align   ?>;
				position: relative;
				vertical-align: <?php echo $vertical_align; ?>;
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_blog_style_watermark_<?php echo $bwg; ?>{
				display: inline-block;
				overflow: hidden;
				position: relative;
				vertical-align: middle;
				z-index: 10140;
				width: <?php echo $params_array['watermark_width'];?>px;
				max-width: <?php echo (($params_array['watermark_width']) / ($params['blog_style_width'])) * 100; ?>%;
				margin: 10px 10px 10px 10px ;
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_blog_style_watermark_text_<?php echo $bwg; ?>{
        display: inline-block;
				overflow: hidden;
				position: relative;
				vertical-align: middle;
				z-index: 10140;
				margin: 10px 10px 10px 10px ;
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_blog_style_watermark_img_<?php echo $bwg; ?>{
				max-width: 100%;
				opacity: <?php echo number_format($params_array['watermark_opacity'] / 100, 2, ".", ""); ?>;
				filter: Alpha(opacity=<?php echo $params_array['watermark_opacity']; ?>);
				position: relative;
				z-index: 10141;
      }
      #bwg_container1_<?php echo $bwg; ?> #bwg_container2_<?php echo $bwg; ?> .bwg_none_selectable {
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
    </style>
    <div id="bwg_container1_<?php echo $bwg; ?>">
      <div id="bwg_container2_<?php echo $bwg; ?>">
        <form id="gal_front_form_<?php echo $bwg; ?>" method="post" action="#">
          <?php
          if ($params['show_search_box']) {
            WDWLibrary::ajax_html_frontend_search_box('gal_front_form_' . $bwg, $bwg, 'bwg_standart_thumbnails_' . $bwg, $images_count, $params['search_box_width']);
          }
          if (isset($params['show_sort_images']) && $params['show_sort_images']) {
            WDWLibrary::ajax_html_frontend_sort_box('gal_front_form_' . $bwg, $bwg, 'bwg_standart_thumbnails_' . $bwg, $params['sort_by'], $params['search_box_width']);
          }
          ?>
          <div class="blog_style_images_conteiner_<?php echo $bwg; ?>">
            <div id="ajax_loading_<?php echo $bwg; ?>" style="position:absolute;width: 100%; z-index: 115; text-align: center; height: 100%; vertical-align: middle; display: none;">
              <div style="display: table; vertical-align: middle; width: 100%; height: 100%; background-color: #FFFFFF; opacity: 0.7; filter: Alpha(opacity=70);">
                <div style="display: table-cell; text-align: center; position: relative; vertical-align: middle;" >
                  <div id="loading_div_<?php echo $bwg; ?>" style="display: inline-block; text-align:center; position: relative; vertical-align: middle;">
                    <img src="<?php echo WD_BWG_URL . '/images/ajax_loader.png'; ?>" class="spider_ajax_loading" style="float: none; width:50px;">
                  </div>
                </div>
              </div>
            </div>
            <?php
            if ($params['blog_style_enable_page'] && $params['blog_style_images_per_page'] && $theme_row->page_nav_position == 'top') {
              WDWLibrary::ajax_html_frontend_page_nav($theme_row, $page_nav['total'], $page_nav['limit'], 'gal_front_form_' . $bwg, $params['blog_style_images_per_page'], $bwg, 'bwg_standart_thumbnails_' . $bwg);
            }
            ?>
            <div class="blog_style_images_<?php echo $bwg; ?>" id="bwg_standart_thumbnails_<?php echo $bwg; ?>" >
              <?php
              foreach ($image_rows as $image_row) {
                $params_array['image_id'] = (isset($_POST['image_id']) ? esc_html($_POST['image_id']) : $image_row->id);
                $popup_url = add_query_arg(array($params_array), admin_url('admin-ajax.php'));
                $is_video = $image_row->filetype == "YOUTUBE" || $image_row->filetype == "VIMEO";
                ?>
                <div class="blog_style_image_buttons_conteiner_<?php echo $bwg; ?>">
                  <div class="blog_style_image_buttons_<?php echo $bwg;?>">
                    <div class="bwg_blog_style_image_<?php echo $bwg; ?>" >
                      <?php
                      if ($show_watermark) {
                        ?>
                        <div class="bwg_blog_style_image_contain_<?php echo $bwg; ?>" id="bwg_blog_style_image_contain_<?php echo $image_row->id ?>">
                          <div class="bwg_blog_style_watermark_contain_<?php echo $bwg; ?>">
                            <div class="bwg_blog_style_watermark_cont_<?php echo $bwg; ?>">
                              <div <?php echo $watermark_div ;?>  >
                                <a class="bwg_none_selectable <?php echo $watermark_a; ?>" id="watermark_a<?php echo $image_row->id; ?>" href="<?php echo urldecode($params_array['watermark_link']); ?>" target="_blank">
                                  <?php echo $watermark_image_or_text ?>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                      }
                      if (!$is_video) {
                      ?>
                      <a style="position:relative;" <?php echo ($params['thumb_click_action'] == 'open_lightbox' ? ('onclick="spider_createpopup(\'' . addslashes(add_query_arg($params_array, admin_url('admin-ajax.php'))) . '\', ' . $bwg . ', ' . $params['popup_width'] . ', ' . $params['popup_height'] . ', 1, \'testpopup\', 5); return false;"') : ($image_row->redirect_url ? 'href="' . $image_row->redirect_url . '" target="' .  ($params['thumb_link_target'] ? '_blank' : '')  . '"' : '')) ?>>
                        <img class="bwg_blog_style_img_<?php echo $bwg; ?>" src="<?php echo site_url() . '/' . $WD_BWG_UPLOAD_DIR . $image_row->image_url; ?>" alt="<?php echo $image_row->alt; ?>" />
                      </a>
                      <?php 
                      }
                      else { ?>
                        <iframe class="bwg_video_frame_<?php echo $bwg; ?>" src="<?php echo ($image_row->filetype == "YOUTUBE" ? "//www.youtube.com/embed/" . $image_row->filename : "//player.vimeo.com/video/" . $image_row->filename); ?>" width="<?php echo $params['blog_style_width']; ?>" height="<?php echo $params['blog_style_width'] * 0.5625; ?>" frameborder="0" allowfullscreen style="position: relative;"></iframe>
                      <?php
                      }
                      ?>
                    </div>
                  </div>
                  <div class="bwg_blog_style_share_buttons_image_alt<?php echo $bwg; ?>">
                    <?php
                    if ($image_title) {
                      ?>
                      <div class="bwg_image_alt_<?php echo $bwg; ?>" id="alt<?php echo $image_row->id; ?>">
                        <?php echo html_entity_decode($image_row->alt); ?>
                      </div>
                      <?php
                    }
                    if (($params['popup_enable_comment'] or $params['popup_enable_facebook'] or $params['popup_enable_twitter'] or $params['popup_enable_google'] or $params['popup_enable_pinterest'] or $params['popup_enable_tumblr']) and ($params['popup_enable_ctrl_btn'])) {
                      $curr_url = add_query_arg($current_url, '', home_url($wp->request));
                      $share_url = add_query_arg(array('action' => 'Share', 'curr_url' => $curr_url, 'image_id' => $image_row->id), admin_url('admin-ajax.php')) . '#bwg' . $params['gallery_id'] . '/' . $image_row->id;
                      $share_image_url = urlencode(($image_row->filetype == "YOUTUBE" || $image_row->filetype == "VIMEO") ? $image_row->thumb_url : site_url() . '/' . $WD_BWG_UPLOAD_DIR . $image_row->image_url);
                      ?>
                      <div class="bwg_blog_style_share_buttons_<?php echo $bwg; ?>">
                        <?php
                        if ($params['popup_enable_comment']) {
                          ?>
                          <a href="javascript:spider_createpopup('<?php echo addslashes(add_query_arg($params_array, admin_url('admin-ajax.php'))); ?>', '<?php echo $bwg; ?>', '<?php echo $params['popup_width']; ?>', '<?php echo $params['popup_height']; ?>', 1, 'testpopup', 5);">
                            <i title="<?php echo __('Show comments', 'bwg'); ?>" class="bwg_comment fa fa-comment"></i>
                          </a>
                          <?php
                        }
                        if ($params['popup_enable_facebook']) {
                          ?>
                          <a id="bwg_facebook_a_<?php echo $image_row->id; ?>" href="https://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?php echo urlencode($share_url); ?>&p[title]=<?php echo $image_row->alt; ?>&p[summary]=<?php echo $image_row->description; ?>&p[images][0]=<?php echo $share_image_url; ?>"  target="_blank" title="<?php echo __('Share on Facebook', 'bwg'); ?>">
                            <i title="<?php echo __('Share on Facebook', 'bwg'); ?>" class="bwg_facebook fa fa-facebook"></i>
                          </a>
                          <?php
                        }
                        if ($params['popup_enable_twitter']) {
                          ?>
                          <a href="https://twitter.com/share?url=<?php echo urlencode($share_url); ?>" target="_blank" title="<?php echo __('Share on Twitter', 'bwg'); ?>">
                            <i title="<?php echo __('Share on Twitter', 'bwg'); ?>" class="bwg_twitter fa fa-twitter"></i>
                          </a>
                          <?php
                        }
                        if ($params['popup_enable_google']) {
                          ?>
                          <a href="https://plus.google.com/share?url=<?php echo urlencode($share_url); ?>" target="_blank" title="<?php echo __('Share on Google+', 'bwg'); ?>">
                            <i title="<?php echo __('Share on Google+', 'bwg'); ?>" class="bwg_ctrl_btn bwg_google fa fa-google-plus"></i>
                          </a>
                          <?php
                        }
                        if ($params['popup_enable_pinterest']) {
                          ?>
                          <a href="http://pinterest.com/pin/create/button/?s=100&url=<?php echo urlencode($share_url); ?>&media=<?php echo $share_image_url; ?>&description=<?php echo $image_row->description; ?>" target="_blank" title="<?php echo __('Share on Pinterest', 'bwg'); ?>">
                            <i title="<?php echo __('Share on Pinterest', 'bwg'); ?>" class="bwg_ctrl_btn bwg_pinterest fa fa-pinterest"></i>
                          </a>
                          <?php
                        }
                        if ($params['popup_enable_tumblr']) {
                          ?>
                          <a href="https://www.tumblr.com/share/photo?source=<?php echo $share_image_url; ?>&caption=<?php echo urlencode($image_row->alt); ?>&clickthru=<?php echo urlencode($share_url); ?>" target="_blank" title="<?php echo __('Share on Tumblr', 'bwg'); ?>">
                            <i title="<?php echo __('Share on Tumblr', 'bwg'); ?>" class="bwg_ctrl_btn bwg_tumblr fa fa-tumblr"></i>
                          </a>
                          <?php
                        }
                        ?>
                      </div>
                      <?php
                    }
                    ?>
                  </div>
                </div>
                <?php
              }
              ?>
            </div>
            <?php
            if ($params['blog_style_enable_page'] && $params['blog_style_images_per_page'] && $theme_row->page_nav_position == 'bottom') {
              WDWLibrary::ajax_html_frontend_page_nav($theme_row, $page_nav['total'], $page_nav['limit'], 'gal_front_form_' . $bwg, $params['blog_style_images_per_page'], $bwg, 'bwg_standart_thumbnails_' . $bwg);
            }
            ?>
          </div>
        </form>
        <div id="spider_popup_loading_<?php echo $bwg; ?>" class="spider_popup_loading"></div>
        <div id="spider_popup_overlay_<?php echo $bwg; ?>" class="spider_popup_overlay" onclick="spider_destroypopup(1000)"></div>
      </div>
    </div>
    <script>
      setTimeout(function(){        
        jQuery('.bwg_video_frame_<?php echo $bwg; ?>').each(function (e) {
          jQuery(this).height(jQuery(this).width() * 0.5625);
        });
      }, 3);
      jQuery(window).resize(function() {
        jQuery('.bwg_video_frame_<?php echo $bwg; ?>').each(function (e) {
          jQuery(this).height(jQuery(this).width() * 0.5625);
        });
      });
      
      jQuery(window).load(function () {
        <?php
        if ($image_right_click) {
          ?>
          /* Disable right click.*/
          jQuery('div[id^="bwg_container"]').bind("contextmenu", function (e) {
            return false;
          });
          <?php
        }
        ?>
      });
      <?php
      if (isset($params_array_hash)) {
      ?>
      var bwg_hash = window.location.hash.substring(1);
      if (bwg_hash) {
        if (bwg_hash.indexOf("bwg") != "-1") {
          bwg_hash_array = bwg_hash.replace("bwg", "").split("/");
          spider_createpopup('<?php echo addslashes(add_query_arg($params_array_hash, admin_url('admin-ajax.php'))); ?>&image_id=' + bwg_hash_array[1], '<?php echo $bwg; ?>', '<?php echo $params['popup_width']; ?>', '<?php echo $params['popup_height']; ?>', 1, 'testpopup', 5);
        }
      }
      <?php
      }
      ?>
    </script>
    <?php
    if ($from_shortcode) {
      return;
    }
    else {
      die();
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////
  // Getters & Setters                                                                  //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Private Methods                                                                    //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Listeners                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
}