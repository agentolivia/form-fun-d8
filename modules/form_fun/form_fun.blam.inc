<?php

/**
 * Form builder for states example.
 * @see http://api.drupal.org/api/drupal/developer--topics--forms_api_reference.html/7#states.
 * @see http://api.drupal.org/api/drupal/includes--common.inc/function/drupal_process_states/7.
 */
function form_fun_blam_form($form, &$form_state) {
  $form['name'] = array(
    '#type' => 'textfield',
    '#title' => t('My name'),
  );

  // Demonstrate the use of the new #states FAPI property. When a user clicks
  // the status checkbox display an additional set of fields.
  $form['status'] = array(
    '#type' => 'checkbox',
    '#title' => t('I have a partner in crime'),
  );

  // The 'Container' element type is handy for controlling multiple elements'
  // states at once.
  $form['partner'] = array(
    '#type' => 'container',
    '#states' => array(
      'visible' => array(
        ':input[name="status"]' => array('checked' => TRUE),
      ),
    ),
  );
  
  $form['partner']['name'] = array(
    '#type' => 'textfield',
    '#title' => t('My partner\'s name'),
  );

  $form['partner']['modus_operandi'] = array(
    '#type' => 'select',
    '#title' => t('My partner\'s M.O.'),
    '#options' => array(
      1 => t('Lock picking'),
      2 => t('Barbed repartee'),
      3 => t('Super-villainy'),
      4 => t('Novelty modules'),
    ),
  );

  return $form;
}