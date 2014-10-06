<?php

/**
 * Implements template_preprocess_html().
 *
 */
function saa_foundation_preprocess_html(&$variables) {
 // Add conditional CSS for IE. To use uncomment below and add IE css file
 drupal_add_css(path_to_theme() . '/css/ie.css', array('weight' => CSS_THEME, 'browsers' => array('!IE' => FALSE), 'preprocess' => FALSE));

 // Need legacy support for IE downgrade to Foundation 2 or use JS file below
 // drupal_add_js('http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js', 'external');
}

/**
 * Implements template_preprocess_page
 *
 */
//function saa_foundation_preprocess_page(&$variables) {
//}

/**
 * Implements template_preprocess_node
 *
 */
//function saa_foundation_preprocess_node(&$variables) {
//}

/**
 * Implements hook_preprocess_block()
 */
function saa_foundation_preprocess_block(&$variables) {
 // Add wrapping div with global class to all block content sections.
 $variables['content_attributes_array']['class'][] = 'block-content';

 // Convenience variable for classes based on block ID
 $block_id = $variables['block']->module . '-' . $variables['block']->delta;

 // Add classes based on a specific block
 switch ($block_id) {
   // System Navigation block
   case 'system-navigation':
     // Custom class for entire block
     $variables['classes_array'][] = 'system-nav';
     // Custom class for block title
     $variables['title_attributes_array']['class'][] = 'system-nav-title';
     // Wrapping div with custom class for block content
     $variables['content_attributes_array']['class'] = 'system-nav-content';
     break;

   // User Login block
   case 'user-login':
     // Hide title
     $variables['title_attributes_array']['class'][] = 'element-invisible';
     break;

   // Example of adding Foundation classes
   case 'block-foo': // Target the block ID
     // Set grid column or mobile classes or anything else you want.
     $variables['classes_array'][] = 'six columns';
     break;
 }

 // Add template suggestions for blocks from specific modules.
 switch($variables['elements']['#block']->module) {
   case 'menu':
     $variables['theme_hook_suggestions'][] = 'block__nav';
   break;
 }
}

//function saa_foundation_preprocess_views_view(&$variables) {
//}

/**
 * Implements template_preprocess_panels_pane().
 *
 */
//function saa_foundation_preprocess_panels_pane(&$variables) {
//}

/**
 * Implements template_preprocess_views_views_fields().
 *
 */
//function saa_foundation_preprocess_views_view_fields(&$variables) {
//}

/**
 * Implements theme_form_element_label()
 * Use foundation tooltips
 */
function saa_foundation_form_element_label($variables) {
 if (!empty($variables['element']['#title'])) {
   $variables['element']['#title'] = '<span class="secondary label">' . $variables['element']['#title'] . '</span>';
 }
 if (!empty($variables['element']['#description'])) {
   $variables['element']['#description'] = ' <span data-tooltip="top" class="has-tip tip-top" data-width="250" title="' . $variables['element']['#description'] . '">' . t('More information?') . '</span>';
 }
 return theme_form_element_label($variables);
}

/**
 * Implements hook_preprocess_button().
 */
function saa_foundation_preprocess_button(&$variables) {
 $variables['element']['#attributes']['class'][] = 'button';
 if (isset($variables['element']['#parents'][0]) && $variables['element']['#parents'][0] == 'submit') {
   $variables['element']['#attributes']['class'][] = 'secondary';
 }
}

/**
 * Implements hook_form_alter()
 * Example of using foundation sexy buttons
 */
function saa_foundation_form_alter(&$form, &$form_state, $form_id) {
 // Sexy submit buttons
 if (!empty($form['actions']) && !empty($form['actions']['submit'])) {
   $form['actions']['submit']['#attributes'] = array('class' => array('primary', 'button', 'radius'));
 }
}

// Sexy preview buttons
function saa_foundation_form_comment_form_alter(&$form, &$form_state) {
 $form['actions']['preview']['#attributes']['class'][] = array('class' => array('secondary', 'button', 'radius'));
}
