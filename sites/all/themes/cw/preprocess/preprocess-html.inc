<?php

/**
 * @file
 */

// add google fonts
$googleapis_href = 'http://fonts.googleapis.com/css?family=';
$roboto = 'Roboto:100,300,500,700,300italic,100italic&subset=latin,cyrillic';
$options = array(
  'type' => 'external',
  'weight' => CSS_SYSTEM,
);
drupal_add_css($googleapis_href . $roboto, $options);

// add css files
$theme = drupal_get_path('theme', variable_get('theme_default', NULL));
drupal_add_css($theme . '/css/ie-lte-7.css', array('weight' => 998, 'group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE 7', '!IE' => FALSE), 'preprocess' => FALSE));
drupal_add_css($theme . '/css/ie-lte-8.css', array('weight' => 999, 'group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE 8', '!IE' => FALSE), 'preprocess' => FALSE));
