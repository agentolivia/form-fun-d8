<?php

/**
 * @file
 * Contains \Drupal\form_fun\Form\FormFunDynamoForm.
 */

namespace Drupal\form_fun\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;
use Drupal\form_fun\Form\FormFunMore;

class FormFunDynamoForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'form_fun_dynamo_form';
  }

  

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#tree'] = TRUE;
  
    // Create a unique HTML DOM ID that can be used when adding/replacing page
    // content via AJAX.
    $form['addresses'] = array(
      '#prefix' => '<div id="addresses">',
      '#suffix' => '</div>',
    );
  
    // If we have stored values from a previous step, re-create
    // the fields for address and populate them properly.
    if ($form_state->getStorage()) {
      foreach ($form_state->getStorage() as $key => $values) {
        $form['addresses'][] = $this->form_fun_address_fields($values);
      }
    }
  
    // Always put a blank field at the end.
    $form['addresses'][] = $this->form_fun_address_fields();
  
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

  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Adding because it's part of FormInterface
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    dsm($form_state);
  }

  /**
   * @todo Please document this function.
   * @see http://drupal.org/node/1354
   */
  public function form_fun_address_fields($values = array()) {
    $values += array(
      'addresstype' => 'home',
      'street' => '',
      'city' => '',
      'state' => '',
      'postcode' => '',
      'country' => '',
    );

    $address_fields = array(
      '#type' => 'fieldset',
      '#collapsible' => FALSE,
    );
    $address_fields['addresstype'] = array(
      '#type' => 'select',
      '#options' => array(
        'home' => t('Home address'),
        'work' => t('Work address'),
        'pobox' => t('Post office box'),
        'other' => t('Other address'),
      ),
      '#title' => t('Address type'),
      '#default_value' => $values['addresstype'],
    );
    $address_fields['street'] = array(
      '#type' => 'textfield',
      '#title' => t("Street"),
      '#default_value' => $values['street'],
    );
    $address_fields['city'] = array(
      '#type' => 'textfield',
      '#title' => t("City"),
      '#default_value' => $values['city'],
    );
    $address_fields['state'] = array(
      '#type' => 'textfield',
      '#title' => t("State"),
      '#default_value' => $values['state'],
    );
    $address_fields['postcode'] = array(
      '#type' => 'textfield',
      '#title' => t("Postal code"),
      '#default_value' => $values['postcode'],
    );
    $address_fields['country'] = array(
      '#type' => 'textfield',
      '#title' => t("Country"),
      '#default_value' => $values['country'],
    );
    return $address_fields;
  }
}
