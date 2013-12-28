<?php

/**
 * @file
 */

if (in_array($vars['elements']['#section'], array('header'))) {
  $vars['attributes_array']['class'][] = drupal_html_class('clearfix');
}