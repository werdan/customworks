<?php
/**
 * @file custom_works.pages.inc
 */

function custom_works_contacts_page() {
  drupal_add_js('http://maps.googleapis.com/maps/api/js?key=AIzaSyAnrwzwZg4RsjtY6CPW5DEs9fvnnhy3jeo&sensor=false&language=ru', 'external');
  drupal_add_js(drupal_get_path('module', 'custom_works') . '/js/contrib/infobubble-compiled.js');
  drupal_add_js(drupal_get_path('module', 'custom_works') . '/js/custom_works.gmap.js');
  return array('#markup' => '<div id="contact-map" style="width: 100%; height: 200px;"></div>');
}
