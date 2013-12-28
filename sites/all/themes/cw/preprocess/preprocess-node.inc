<?php

/**
 * @file
 */

$node = $vars['node'];

// // add class to node
// if ($vars['view_mode'] == 'view_block') {
//   $vars['classes_array'][]= drupal_html_class('node-view-block');
//   $vars['attributes_array']['class'][] = drupal_html_class('node-view-block');
// }

// if (!empty($vars['field_technology_image'])) {
//   $images = field_get_items('node', $node, 'field_technology_image');
//   if (!empty($images)) {
//     $display = array(
//       'label'    => 'hidden',
//       'type'     => 'image',
//       'settings' => array(
//         'image_style' => '140_gray',
//       ),
//     );
//     $images_gray = field_view_field('node', $node, 'field_technology_image', $display);
//     $vars['content']['field_technology_image_gray'] = $images_gray;
//   }
// }

// // unset statistics
// if (!empty($vars['content']['links']['statistics'])) {
//   unset($vars['content']['links']['statistics']);
// }

// add slider omega-grid
if (in_array($vars['type'], array('page'))) {
  if (!empty($vars['field_image']) && !empty($vars['body'])) {
    $vars['content_attributes_array']['class'][] = drupal_html_class('omega-grid');
  }
}
// add blog omega-grid
if (in_array($vars['type'], array('blog'))) {
  if ($vars['view_mode'] == 'teaser') {
    $vars['classes_array'][] = drupal_html_class('node-is-teaser');
    $vars['classes_array'][] = drupal_html_class('omega-grid');
    $vars['attributes_array']['class'][] = drupal_html_class('node-is-teaser');
    $vars['attributes_array']['class'][] = drupal_html_class('omega-grid');
    if (!empty($vars['field_featured_image'])) {
      $vars['content_attributes_array']['class'][] = drupal_html_class('grid-9');
    }
  }
  if ($vars['view_mode'] == 'full') {
    $vars['classes_array'][] = drupal_html_class('node-full');
    $vars['attributes_array']['class'][] = drupal_html_class('node-full');
    $url = 'blog';
    $is_external = FALSE;
    $referer = (!empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : NULL;
    $pos = strpos($referer, $url);
    if ($pos !== FALSE) {
      $url = $referer;
      $is_external = TRUE;
    }
    $options = array(
      'external' => $is_external,
      'attributes' => array(
        'class' => 'back-to',
      ),
    );
    $vars['link_back_to_blog'] = l('« '. t('back to Blog'), $url, $options);
  }
}

// products
if (in_array($vars['type'], array('product'))) {
  if ($vars['view_mode'] == 'teaser') {
    $vars['classes_array'][] = drupal_html_class('node-is-teaser');
    $vars['attributes_array']['class'][] = drupal_html_class('node-is-teaser');
  }
  if ($vars['view_mode'] == 'full') {
    $vars['classes_array'][] = drupal_html_class('omega-grid');
    $vars['attributes_array']['class'][] = drupal_html_class('omega-grid');
    $vars['classes_array'][] = drupal_html_class('node-full');
    $vars['attributes_array']['class'][] = drupal_html_class('node-full');
    $vars['content_attributes_array']['class'][] = drupal_html_class('grid-11');
    $url = 'products';
    $is_external = FALSE;
    $referer = (!empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : NULL;
    $pos = strpos($referer, $url);
    if ($pos !== FALSE) {
      $url = $referer;
      $is_external = TRUE;
    }
    $options = array(
      'external' => $is_external,
      'attributes' => array(
        'class' => 'back-to',
      ),
    );
    $vars['link_back_to_products'] = l('« '. t('back to products'), $url, $options);
  }
}
