<?php

/**
 * @file
 * Contains \Drupal\form_fun\Form\FormFunExistential.
 */

namespace Drupal\form_fun\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;

class FormFunExistential extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'form_fun_existential';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['identity'] = array(
      '#type' => 'fieldset',
      '#title' => t('Existential questions'),
      '#description' => t('Please validate your existence.'),
      '#collapsible' => TRUE,
    );
  
    $form['identity']['existence'] = array(
      '#type' => 'checkbox',
      '#title' => t('Yes, I exist.'),
      '#default_value' => TRUE,
    );
    $form['identity']['fruitiness'] = array(
      '#type' => 'checkbox',
      '#title' => t('Also, I am a banana.'),
      '#default_value' => FALSE,
    );
    $form['identity']['euthyphro'] = array(
      '#type' => 'textarea',
      '#title' => t("Is moral goodness implicit or ascribed?"),
    );
  
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Submit'),
    );
    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Adding because it's part of FormInterface
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    dsm($form_state);
  }
}
