<?php

/**
 * @file
 */

if (in_array($vars['elements']['#region'], array('menu'))) {
  $vars['site_phone'] = variable_get('custom_works_phone', NULL);
  $vars['site_mail'] = variable_get('site_mail', NULL);
}
if (in_array($vars['elements']['#region'], array('content'))) {
  $vars['hide_title'] = FALSE;
  $theme = alpha_get_theme();
  $node = (!empty($theme->page['node'])) ? $theme->page['node'] : NULL;
  if ($node) {
    if ($node->type == 'blog' || $node->type == 'product') {
      if (!empty($vars['elements']['system_main']['nodes'][$node->nid]['#view_mode'])) {
        if ($vars['elements']['system_main']['nodes'][$node->nid]['#view_mode'] == 'full') {
          $vars['hide_title'] = TRUE;
        }
      }
    }
  }
}
