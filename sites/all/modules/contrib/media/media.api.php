<?php

/**
 * @file
 * Hooks provided by the Media module.
 */

/**
 * Parses a url or embedded code into a unique URI.
 *
 * @param string $url
 *   The original URL or embed code to parse.
 *
 * @return array
 *   The unique URI for the file, based on its stream wrapper, or NULL.
 *
 * @see media_parse_to_file()
 * @see media_add_from_url_validate()
 */
function hook_media_parse($url) {
  // Only parse URLs from our website of choice: examplevideo.com
  if (substr($url, 0, 27) == 'http://www.examplevideo.com') {
    // Each video has a 5 digit ID, i.e. http://www.examplevideo.com/12345
    // Grab the ID and use it in our URI.
    $id = substr($url, 28, 33);
    return file_stream_wrapper_uri_normalize('examplevideo://video/' . $id);
  }
}

/**
 * Returns a list of plugins for the media browser.
 *
 * @return array
 *   A nested array of plugin information, keyed by plugin name. Each plugin
 *   info array may have the following keys:
 *   - title: (required) A name for the tab in the media browser.
 *   - class: (required) The class name of the handler. This class must
 *     implement a view() method, and may (should) extend the
 *     @link MediaBrowserPlugin MediaBrowserPlugin @endlink class.
 *   - weight: (optional) Integer to determine the tab order. Defaults to 0.
 *   - access callback: (optional) A callback for user access checks.
 *   - access arguments: (optional) An array of arguments for the user access
 *   check.
 *
 * Additional custom keys may be provided for use by the handler.
 *
 * @see hook_media_browser_plugin_info_alter()
 * @see media_get_browser_plugin_info()
 */
function hook_media_browser_plugin_info() {
  $info['media_upload'] = array(
    'title' => t('Upload'),
    'class' => 'MediaBrowserUpload',
    'weight' => -10,
    'access callback' => 'user_access',
    'access arguments' => array('create files'),
  );

  return $info;
}

/**
 * Alter the list of plugins for the media browser.
 *
 * @param array $info
 *   The associative array of media browser plugin definitions from
 *   hook_media_browser_plugin_info().
 *
 * @see hook_media_browser_plugin_info()
 * @see media_get_browser_plugin_info()
 */
function hook_media_browser_plugin_info_alter(&$info) {
  $info['media_upload']['title'] = t('Upload 2.0');
  $info['media_upload']['class'] = 'MediaBrowserUploadImproved';
}

/**
 * Alter the plugins before they are rendered.
 *
 * @param array $plugin_output
 *   The associative array of media browser plugin information from
 *   media_get_browser_plugin_info().
 *
 * @see hook_media_browser_plugin_info()
 * @see media_get_browser_plugin_info()
 */
function hook_media_browser_plugins_alter(&$plugin_output) {
  $plugin_output['upload']['form']['upload']['#title'] = t('Upload 2.0');
  $plugin_output['media_internet']['form']['embed_code']['#size'] = 100;
}

/**
 * Alter a singleton of the params passed to the media browser.
 *
 * @param array $stored_params
 *   An array of parameters provided when a media_browser is launched.
 *
 * @see media_browser()
 * @see media_set_browser_params()
 */
function hook_media_browser_params_alter(&$stored_params) {
  $stored_params['types'][] = 'document';
  unset($stored_params['enabledPlugins'][0]);
}

/**
 * Alter a list of view modes allowed for a file embedded in the WYSIWYG.
 *
 * @param array $view_modes
 *   An array of view modes that can be used on the file when embedded in the
 *   WYSIWYG.
 * @param object $file
 *   A file entity.
 *
 * @see media_get_wysiwyg_allowed_view_modes()
 */
function hook_media_wysiwyg_allowed_view_modes_alter(&$view_modes, $file) {
  $view_modes['default']['label'] = t('Display an unmodified version of the file');
  unset($view_modes['preview']);
}

/**
 * Alter the WYSIWYG view mode selection form.
 *
 * Similar to a form_alter, but runs first so that modules can add
 * fields specific to a given file type (like alt tags on images) before alters
 * begin to work on the fields.
 *
 * @param array $form
 *   An associative array containing the structure of the form.
 * @param array $form_state
 *   An associative array containing the current state of the form.
 * @param object $file
 *   A file entity.
 *
 * @see media_format_form()
 */
function hook_media_format_form_prepare_alter(&$form, &$form_state, $file) {
  $form['preview']['#access'] = FALSE;

  $file = $form['#media'];
  $form['heading']['#markup'] = t('Embedding %filename of type %filetype', array('%filename' => $file->filename, '%filetype' => $file->type));
}

/**
 * Alter the output generated by Media filter tags.
 *
 * @param array $element
 *   The renderable array of output generated for the filter tag.
 * @param array $tag_info
 *   The filter tag converted into an associative array by
 *   media_token_to_markup() with the following elements:
 *   - 'fid': The ID of the media file being rendered.
 *   - 'file': The object from file_load() of the media file being rendered.
 *   - 'view_mode': The view mode being used to render the file.
 *   - 'attributes': An additional array of attributes that could be output
 *     with media_get_file_without_label().
 * @param array $settings
 *   An additional array of settings.
 *   - 'wysiwyg': A boolean if the output is for the WYSIWYG preview or FALSE
 *     if for normal rendering.
 *
 * @see media_token_to_markup()
 */
function hook_media_token_to_markup_alter(&$element, $tag_info, $settings) {
  if (empty($settings['wysiwyg'])) {
    $element['#attributes']['alt'] = t('This media has been output using the @mode view mode.', array('@mode' => $tag_info['view_mode']));
  }
}
