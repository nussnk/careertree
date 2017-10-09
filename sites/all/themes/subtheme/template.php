<?php
/**
 * @file
 * The primary PHP file for this theme.
 */
function subtheme_form_alter(&$form, &$form_state, $form_id) {
  $print = '<pre>' . print_r($form, TRUE) . '</pre>';
//    if($form_id == 'views_exposed_form') {
      drupal_set_message($print);
	$form['field_category_tid']['#multiple'] = 1;
//    }
      $form['pass']['#weight'] = -2;

}