<?php

/**
 * The `$settings` configuration variable is an array that contains all of the
 * configurable settings for this theme. Each setting is an array of its own,
 * containing each of the following key/value pairs:
 *
 * 'type'
 * The UI control to render for the current setting.
 * Possible values include 'colorpicker', 'slider', 'numeric', or 'visibility'.
 *
 * 'label'
 * The i18n-compatible label for this particular setting.
 *
 * 'id'
 * An arbitrary identifier string to associate with the UI control's form field.
 *
 * 'value'
 * The default CSS value for this setting.
 *
 * 'pro'
 * Whether or not this setting requires the Vimeography Pro plugin to
 * be installed. TRUE if `type` is 'colorpicker', otherwise FALSE.
 *
 * 'namespace'
 * Whether or not the DOM element being targeted by the CSS is a child of the
 * vimeography-gallery-{{gallery_id}} container. Usually TRUE, unless your theme
 * uses a fancybox plugin, in which case, the modal window is outside of the container
 * element, so FALSE would be appropriate.
 *
 * 'properties'
 * Defines which CSS selectors and properties that the setting will control.
 * An array of one or more arrays, with each array containing two key/value pairs:
 *
 *   - `target` defines the CSS selector that the setting will affect
 *
 *   - `attribute` defines the CSS property that this setting will
 *      control for the corresponding target selector.
 *
 * 'expressions' - optional
 * Defines additional CSS selectors and properties that the setting will control,
 * but this time, relatively manipulating the value before associating it with the
 * selector. This is useful if you have two selectors whose values are linked and
 * change relative to one another (widescreen image ratios, margins etc.)
 *
 * An array of one or more arrays, which each array containing four key/value pairs:
 *
 *   - `target` defines the CSS selector that the setting will affect
 *
 *   - `attribute` defines the CSS property that this setting will
 *      control for the target selector.
 *
 *   - `operator` defines the symbol(s) to use for the mathmatical operation to perform
 *      on the original setting value.
 *
 *   - `value` is the input integer which acts as the addend, subtrahend, divisor, multiplier etc.
 *      to the original setting value.
 *
 * 'important' - optional
 * If set to TRUE, the CSS rule will be saved with an `!important` flag.
 *
 * 'min' - optional [required if `type` is 'slider' or 'numeric']
 * The minimum value that a CSS property can be set.
 *
 * 'max' - optional [required if `type` is 'slider' or 'numeric']
 * The maximum value that a CSS property can be set.
 *
 * 'step' - optional [required if `type` is 'slider' or 'numeric']
 * The increment/decrement value of the UI control.
 *
 * @var array
 */
$settings = array(
  array(
    'type'       => 'colorpicker',
    'label'      => __('Active Thumbnail Background Color', 'vimeography-playlister'),
    'id'         => 'active-thumbnail-background-color',
    'value'      => '#555555',
    'pro'        => FALSE,
    'namespace'  => TRUE,
    'properties' =>
      array(
        array('target' => '.vimeography-playlister .vimeography-thumbnail.vimeography-active a', 'attribute' => 'backgroundColor'),
      )
  ),
  array(
    'type'       => 'colorpicker',
    'label'      => __('Inactive Thumbnail Background Color', 'vimeography-playlister'),
    'id'         => 'inactive-thumbnail-background-color',
    'value'      => '#444444',
    'pro'        => FALSE,
    'namespace'  => TRUE,
    'properties' =>
      array(
        array('target' => '.vimeography-playlister .vimeography-thumbnail a', 'attribute' => 'backgroundColor'),
      )
  ),
  array(
    'type'       => 'colorpicker',
    'label'      => __('Hovered Thumbnail Background Color', 'vimeography-playlister'),
    'id'         => 'hovered-thumbnail-background-color',
    'value'      => '#555555',
    'pro'        => FALSE,
    'namespace'  => TRUE,
    'properties' =>
      array(
        array('target' => '.vimeography-playlister .vimeography-thumbnail a:hover', 'attribute' => 'backgroundColor'),
      )
  ),
  array(
    'type'       => 'colorpicker',
    'label'      => __('Active Download Background Color', 'vimeography-playlister'),
    'id'         => 'active-download-background-color',
    'value'      => '#555555',
    'pro'        => FALSE,
    'namespace'  => TRUE,
    'properties' =>
      array(
        array('target' => '.vimeography-playlister .vimeography-thumbnail.vimeography-active .vimeography-downloads', 'attribute' => 'backgroundColor'),
      )
  ),
  array(
    'type'       => 'colorpicker',
    'label'      => __('Inactive Download Background Color', 'vimeography-playlister'),
    'id'         => 'inactive-download-background-color',
    'value'      => '#444444',
    'pro'        => FALSE,
    'namespace'  => TRUE,
    'properties' =>
      array(
        array('target' => '.vimeography-playlister .vimeography-thumbnail .vimeography-downloads', 'attribute' => 'backgroundColor'),
      )
  ),
  array(
    'type'       => 'colorpicker',
    'label'      => __('Hovered Download Background Color', 'vimeography-playlister'),
    'id'         => 'hovered-download-background-color',
    'value'      => '#555555',
    'pro'        => FALSE,
    'namespace'  => TRUE,
    'properties' =>
      array(
        array('target' => '.vimeography-playlister .vimeography-thumbnail .vimeography-downloads:hover', 'attribute' => 'backgroundColor'),
      )
  ),
  array(
    'type'       => 'colorpicker',
    'label'      => __('Video Separator Line Color', 'vimeography-playlister'),
    'id'         => 'video-separator-line-color',
    'value'      => '#333333',
    'pro'        => FALSE,
    'namespace'  => TRUE,
    'properties' =>
      array(
        array('target' => '.vimeography-playlister .vimeography-thumbnail', 'attribute' => 'borderBottomColor'),
      )
  ),
  array(
    'type'       => 'colorpicker',
    'label'      => __('Video Title Color', 'vimeography-playlister'),
    'id'         => 'video-title-color',
    'value'      => '#dddddd',
    'pro'        => FALSE,
    'namespace'  => TRUE,
    'properties' =>
      array(
        array('target' => '.vimeography-playlister .vimeography-thumbnail figcaption h1', 'attribute' => 'color'),
      )
  ),
  array(
    'type'       => 'colorpicker',
    'label'      => __('Video Description Color', 'vimeography-playlister'),
    'id'         => 'video-description-color',
    'value'      => '#bbbbbb',
    'pro'        => FALSE,
    'namespace'  => TRUE,
    'properties' =>
      array(
        array('target' => '.vimeography-playlister .vimeography-thumbnail figcaption p', 'attribute' => 'color'),
      )
  ),
  array(
    'type'       => 'slider',
    'label'      => __('Video Title Size', 'vimeography-playlister'),
    'id'         => 'video-title-size',
    'value'      => '12',
    'min'        => '10',
    'max'        => '20',
    'step'       => '1',
    'pro'        => TRUE,
    'namespace'  => TRUE,
    'properties' =>
      array(
        array('target' => '.vimeography-playlister .vimeography-thumbnail figcaption h1', 'attribute' => 'fontSize'),
      )
  ),
  array(
    'type'       => 'slider',
    'label'      => __('Video Description Size', 'vimeography-playlister'),
    'id'         => 'video-description-size',
    'value'      => '11',
    'min'        => '10',
    'max'        => '18',
    'step'       => '1',
    'pro'        => TRUE,
    'namespace'  => TRUE,
    'properties' =>
      array(
        array('target' => '.vimeography-playlister .vimeography-thumbnail figcaption p', 'attribute' => 'fontSize'),
      )
  ),
);