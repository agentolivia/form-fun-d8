<?php

/**
 * @file
 * Contains \Drupal\form_fun\Form\FormFunCake.
 */

namespace Drupal\form_fun\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;

class FormFunCake extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'form_fun_cake';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['choice'] = array(
      '#type' => 'select',
      '#title' => t('Cake or death'),
      '#description' => t('You must have tea and cake with the vicar... or you die!'),
      '#options' => array(
        'cake' => t('Cake with the vicar'),
        'death' => t('Death'),
        'chicken' => t('Chicken'),
      ),
      '#default_value' => 'cake',
      '#required' => TRUE,
    );

    $form['buttons']['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Submit'),
    );

    // Because the 'unsure' button has a #submit property, that function
    // will be called if it is clicked instead of the form's default
    // submit handler.
    $form['buttons']['unsure'] = array(
      '#type' => 'submit',
      '#value' => t('Equivocate'),
      // Call the equivocate method in this class.
      '#submit' => array('::equivocate'),

      // No validation at all is required in the equivocate case, so
      // we include this here to make it skip the form-level validator.
      '#validate' => array(),
    );
    return $form;
  }


  public function validateForm(array &$form, FormStateInterface $form_state) {
    if ($form_state->getValue('choice') == 'cake') {
      $form_state->setErrorByName(
        'choice',
        $this->t("We're out of cake! We only had three bits and we didn't expect such a rush.")
      );
    }
  }


  public function submitForm(array &$form, FormStateInterface $form_state) {
    switch($form_state->getValue('choice')) {
      case 'cake':
        $form_state->setRedirect('form_fun.cake_image');
        break;
      case 'death':
        $form_state->setRedirect('form_fun.death_image');
        break;
      case 'chicken':
        $form_state->setRedirect('form_fun.chicken_image');
        break;
      default:
        $form_state->setRedirect('form_fun.cake_page');
        break;
    }
  }

  /**
   * The function is ONLY called if the 'equivocate' button is clicked.
   * Otherwise, the normal submit handler is called.
   */
  public function equivocate(array &$form, FormStateInterface $form_state) {
    dsm(t('Make up your mind!'));
  }
}
