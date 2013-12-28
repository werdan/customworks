<?php

/**
 * @file
 */

// Remove main block from front page
if (!empty($vars['is_front']) && $vars['is_front'] == TRUE) {
  if (!empty($vars['page']['content']['content']['content']['system_main'])) {
    unset($vars['page']['content']['content']['content']['system_main']);
  }
}

if (in_array('page__contacts', $vars['theme_hook_suggestions'])) {
  $contact_text = variable_get('custom_works_contact_page_text', NULL);
  $coordinates = variable_get('custom_works_contact_page_coordinates', NULL);
  $vars['contact_popup'] = '<div id="contact-popup" data-latitude="' . $coordinates['latitude'] . '" data-longitude="' . $coordinates['longitude'] . '">' . $contact_text['value'] . '</div>';
}
