<?php

class BWGViewShare {
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
  public function display() {
    global $WD_BWG_UPLOAD_DIR;
    if (isset($_GET['image_id'])) {
      $get_image_id = $_GET['image_id'];
      $cur_image_row = $this->model->get_image_row_data($get_image_id);
      ?>
      <html>
        <head>
          <meta property="og:image" name="bwg_image" content="<?php echo ($cur_image_row->filetype == "YOUTUBE" || $cur_image_row->filetype == "VIMEO") ? $cur_image_row->thumb_url : site_url() . '/' . $WD_BWG_UPLOAD_DIR . str_replace(' ', '%20', $cur_image_row->image_url); ?>" />
          <meta property="og:title" name="bwg_title" content="<?php echo $cur_image_row->alt; ?>" />
          <meta property="og:description" name="bwg_description" content="<?php echo $cur_image_row->description; ?>" />
        </head>
        <body style="display:none;">
          <img src="<?php echo ($cur_image_row->filetype == "YOUTUBE" || $cur_image_row->filetype == "VIMEO") ? $cur_image_row->thumb_url : site_url() . '/' . $WD_BWG_UPLOAD_DIR . str_replace(' ', '%20', $cur_image_row->image_url); ?>">
        </body>
      </html>
      <?php
    }
    ?>
    <script>
      var bwg_hash = window.parent.location.hash;
      if (bwg_hash) {
        if (bwg_hash.indexOf("bwg") == "-1") {
          bwg_hash = bwg_hash.replace("#", "#bwg");
        }
        window.location.href = "<?php echo (isset($_GET['curr_url']) ? $_GET['curr_url'] : ''); ?>" + bwg_hash;
      }
    </script>
    <?php
    die();
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