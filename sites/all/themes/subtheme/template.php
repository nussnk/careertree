<?php
/**
 * @file
 * The primary PHP file for this theme.
 */
function subtheme_theme(&$existing, $type, $theme, $path) {
  $hooks['user_login_block'] = array(
    'template' => 'templates/user_login_block',
    'render element' => 'form',
  );
/*  $hooks['user_login'] = array(
    'template' => 'templates/user_login',
    'render element' => 'form',
  );*/
  return $hooks;
}

function subtheme_preprocess_user_login_block(&$variables) {

  $variables['form']['name']['#title'] = "";
  $variables['form']['pass']['#title'] = "";
  $variables['form']['name']['#attributes']['placeholder'] = "Username*";
  $variables['form']['pass']['#attributes']['placeholder'] = "Password*";

  $variables['form']['name']['#required'] = true;
  $variables['form']['pass']['#required'] = true;

  $variables['rendered'] = drupal_render_children($variables['form']);
}

/*
function subtheme_preprocess_user_login(&$variables) {

  $variables['form']['name']['#title'] = "";
  $variables['form']['pass']['#title'] = "";
  $variables['form']['name']['#attributes']['placeholder'] = "Username*";
  $variables['form']['pass']['#attributes']['placeholder'] = "Password*";

  $variables['form']['name']['#required'] = true;
  $variables['form']['pass']['#required'] = true;

  $variables['rendered'] = drupal_render_children($variables['form']);
}
*/



function subtheme_form_alter(&$form, &$form_state, $form_id) {
    if($form_id == 'user_login_block') {
      $form['name']['#weight'] = -3;
      $form['pass']['#weight'] = -2;
      $form['actions']['#weight'] = -1;
    }
 /*   if($form_id == 'user_login') {
      $form['name']['#weight'] = -3;
      $form['pass']['#weight'] = -2;
      $form['actions']['#weight'] = -1;
    }*/
}

function subtheme_menu_link(array $variables) {
  //$links = $variables['links'];
  $element = $variables['element'];
  $sub_menu = '';
  $image = '';
  
  if(isset($variables['element']['#original_link']['options']['content']['image']) && drupal_is_front_page()){
    $file = file_load($variables['element']['#original_link']['options']['content']['image']);
    $path = '/' . variable_get('file_public_path', conf_path() . '/files') . '/' . file_uri_target($file->uri);
    $image = '<a href="'. $element['#href'] .'"><img src="'. $path . '"></a>';
 
  }
  if ($variables['element']['#href'] == current_path() ||
          ($variables['element']['#href'] == '<front>' && drupal_is_front_page())) {
    $element['#attributes']['class'][] = 'menu-active';
 }
  
  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $image . $output . $sub_menu . "</li>\n";
}

