<?php /**
 * @file
 * Contains \Drupal\form_fun\Controller\DefaultController.
 */

namespace Drupal\form_fun\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;

/**
 * Default controller for the form_fun module.
 */
class DefaultController extends ControllerBase {


  public function form_fun_page() {
    // List of links to the other forms.

    // Death or Cake? (The basics)

    $links[] = $this->l(
      $this->t('Death, or cake? (The basics)'), new Url('form_fun.cake_page')
    );

/*
    // Existential questions (Peeking at form state!)
    $url = Url::fromRoute('form_fun.existential');
    $text = 'Existential questions (Peeking at form state!)';
    $links[] = \Drupal::l(t($text), $url);

    // I'm lost! (Nested form elements)
    $url = Url::fromRoute('form_fun.tree');
    $text = "I'm lost! (Nested form elements)";
    $links[] = \Drupal::l(t($text), $url);

    // Gimmie more (Multi-step forms)
    $url = Url::fromRoute('form_fun.more');
    $text = 'Gimmie more (Multi-step forms)';
    $links[] = \Drupal::l(t($text), $url);

    // Blam! (States examples)
    $url = Url::fromRoute('form_fun.blam_form');
    $text = 'Blam! (States examples)';
    $links[] = \Drupal::l(t($text), $url);

    // Dynamo! (AJAX powered forms)
    $url = Url::fromRoute('form_fun.dynamo_form');
    $text = 'Dynamo! (AJAX powered forms)';
    $links[] = \Drupal::l(t($text), $url);
*/
    // Preparing a render array of a HTML item list of the $links array.
    // @FIXME
    // #title value outputs twice on page, as H1 and H3. Fix in twig file.
    $item_list = array(
      '#theme' => 'item_list',
      '#items' => $links,
      '#title' => t('Fun with FormAPI!'),
    );

    // Returning the render array that produces an HTML list of links.
    return $item_list;
  }

  public function form_fun_cake_page() {
    $form = \Drupal::formBuilder()->getForm('Drupal\form_fun\Form\FormFunCake');
    return $form;
  }

  public function form_fun_death_image() {
    $url = Url::fromRoute('form_fun.cake_page');
    $text = 'Return to the form';
    $link = \Drupal::l(t($text), $url);

    $img = array(
      '#type' => 'markup',
      '#prefix' => '<p>&laquo;' . $link . '</p>',
      '#markup' => "<img src='http://starphoenixbase.com/wp-content/uploads/2006/10/coyote-06.jpg' />",
    );
    return $img;
  }

  public function form_fun_cake_image() {
    $url = Url::fromRoute('form_fun.cake_page');
    $text = 'Return to the form';
    $link = \Drupal::l(t($text), $url);


    $img = array(
      '#type' => 'markup',
      '#prefix' => '<p>&laquo;' . $link . '</p>',
      '#markup' => "<img src='http://i.guim.co.uk/static/w-620/h--/q-95/sys-images/Guardian/Pix/pictures/2008/09/30/afternoontea460.jpg' />",
    );
    return $img;
  }

  public function form_fun_chicken_image() {
    $url = Url::fromRoute('form_fun.cake_page');
    $text = 'Return to the form';
    $link = \Drupal::l(t($text), $url);

    $img = array(
      '#type' => 'markup',
      '#prefix' => '<p>&laquo;' . $link . '</p>',
      '#markup' => "<img src='http://www.arenaflowers.com/product_image/large/600-mohican_chicken.jpg' />",
    );
    return $img;
  }

}