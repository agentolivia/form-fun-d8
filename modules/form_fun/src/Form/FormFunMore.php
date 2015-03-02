<?php

/**
 * @file
 * Contains \Drupal\form_fun\Form\FormFunMore.
 */

namespace Drupal\form_fun\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;

class FormFunMore extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'form_fun_more';
  }

  

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#tree'] = TRUE;
  
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
      '#value' => t('Give me another address'),
      '#submit' => array('form_fun_more_more'),
    );
    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Adding because it's part of FormInterface
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    //unset($form_state->getStorage());
    drupal_set_message(t('Your addresses were submitted!'));
    dsm($form_state->getValue(['addresses']));
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
