<?php

/**
 * @file
 */

/**
 * Implements template_preprocess_field
 */
function cw_preprocess_field(&$vars) {
  $element = &$vars['element'];
  // Add classes to fields
  $field_name = $element['#field_name'];
  switch($field_name) {
    case 'body':
      if ($element['#bundle'] == 'page' && $element['#view_mode'] == 'full') {
        if (!empty($element['#object']->field_image)) {
          $vars['classes_array'][] = drupal_html_class('grid-14');
          $vars['classes_array'][] = drupal_html_class('suffix-1');
          $vars['classes_array'][] = drupal_html_class('pull-9');
        }
      }
      break;
    case 'field_slider_link':
      $vars['classes_array'][] = drupal_html_class('button');
      break;
    case 'field_image':
      if ($element['#bundle'] == 'page' && $element['#view_mode'] == 'full') {
        if (!empty($element['#object']->body)) {
          $vars['classes_array'][] = drupal_html_class('grid-9');
          $vars['classes_array'][] = drupal_html_class('push-15');
        }
      }
      break;
    case 'field_featured_image':
      if ($element['#bundle'] == 'blog' && $element['#view_mode'] == 'teaser') {
        $vars['classes_array'][] = drupal_html_class('grid-10');
        $vars['classes_array'][] = drupal_html_class('suffix-1');
      }
      break;
    case 'field_footer_body':
      if ($element['#bundle'] == 'blog' && $element['#view_mode'] == 'full') {
        if (!empty($element['#object']->field_blog_callout)) {
          $vars['classes_array'][] = drupal_html_class('grid-19');
          $vars['classes_array'][] = drupal_html_class('alpha');
        }
      }
      break;
    case 'field_blog_callout':
      if ($element['#bundle'] == 'blog' && $element['#view_mode'] == 'full') {
        $vars['classes_array'][] = drupal_html_class('grid-5');
        $vars['classes_array'][] = drupal_html_class('omega');
      }
      break;
  }
}

