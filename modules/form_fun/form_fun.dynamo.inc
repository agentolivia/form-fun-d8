<?php

// Include this file so we can use some functions from the previous example.
include_once(drupal_get_path('module', 'form_fun') . '/form_fun.more.inc');

/**
 * Form builder for AJAX callback example.
 * @see http://api.drupal.org/api/drupal/includes--ajax.inc/group/ajax/7.
 *
 * Note that this function is called every time the form is built, this includes
 * during AJAX requests so you can put complicated form building logic into this
 * function and then simply return the portion of the form that was added/modified
 * by an AJAX request in the callback function. This way forms will gracefully
 * degrade to the same submit based mechanism used in the previous example.
 */
function form_fun_dynamo_form($form, &$form_state) {
  $form['#tree'] = TRUE;

  // Create a unique HTML DOM ID that can be used when adding/replacing page
  // content via AJAX.
  $form['addresses'] = array(
    '#prefix' => '<div id="addresses">',
    '#suffix' => '</div>',
  );

  // If we have stored values from a previous step, re-create
  // the fields for address and populate them properly.
  if (!empty($form_state['storage'])) {
    foreach ($form_state['storage'] as $key => $values) {
      $form['addresses'][] = form_fun_address_fields($values);
    }
  }

  // Always put a blank field at the end.
  $form['addresses'][] = form_fun_address_fields();

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Submit'),
  );
  $form['more'] = array(
    '#type' => 'submit',
    // Use #ajax property to define what to do when this button is clicked.
    // Drupal will make an AJAX request to the system/ajax path and trigger
    // the specified callback function automatically.
    '#ajax' => array(
      // Name of function to call when this button is clicked.
      'callback' => 'form_fun_dynamo_callback',
      // ID of the DOM element to affect when results are returned from the
      // callback.
      'wrapper' => 'addresses',
      // (optional) effect to use when adding new content to the page.
      'effect' => 'slide',
      // (optional) method to use when adding new content to the page. Can be
      // any jQuery DOM manipulation method.
      'method' => 'append',
    ),
    '#value' => t('Give me another address'),
    '#submit' => array('form_fun_more_more'),
  );
  return $form;
}

/**
 * AJAX callback triggered when clicking the "more" button on the
 * form_fun_dynamo form.
 */
function form_fun_dynamo_callback($form, $form_state) {
  // Return just the address field that was added during the $form build process
  // for this request since we're using the 'append' method instead of the
  // default replace.
  $num_fields = count(\Drupal\Core\Render\Element::children($form['addresses'])) - 1;
  return $form['addresses'][$num_fields];
}

/**
 * Submit callback for form_fun_dynamo_form().
 */
function form_fun_dynamo_form_submit($form, &$form_state) {
  dsm($form_state);
}
