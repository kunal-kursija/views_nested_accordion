<?php

namespace Drupal\views_nested_accordion\Plugin\views\style;

use Drupal\Core\Form\FormStateInterface;
use Drupal\views_accordion\Plugin\views\style\ViewsAccordion;

/**
 * Style plugin to render each item in an ordered or unordered list.
 *
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "views_nested_accordion",
 *   title = @Translation("Views nested Accordion"),
 *   help = @Translation("Display Nested Accordion."),
 *   theme = "views_accordion_view",
 *   display_types = {"normal"}
 * )
 */
class ViewsNestedAccordion extends ViewsAccordion {
  /**
   * {@inheritdoc}
   */
  protected $usesRowPlugin = TRUE;

  /**
   * {@inheritdoc}
   */
  protected $usesRowClass = TRUE;

  /**
   * Set default options.
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    $options['nestedaccordion'] = array('default' => 0);
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);
    $form['nestedaccordion'] = array(
      '#type' => 'checkbox',
      '#title' => t('Nested Accordion'),
      '#default_value' => $this->options['nestedaccordion'],
      '#description' => t('If set, nested accordion will be implemented.'),
      '#weight' => -1,
    );
  }

  /**
   * {@inheritdoc}
   */
  public function render() {
    $output = parent::render();
    $view_settings['viewname'] = $this->view->id();
    $view_settings['nestedaccordion'] = $this->options['nestedaccordion'];
    if ($this->options['nestedaccordion'] == TRUE) {
      $this->view->element['#attached']['library'][] = 'views_nested_accordion/views.nested_accordion';
    }
    $this->view->element['#attached']['drupalSettings']['views_nested_accordion'] = ['nestedaccordion' => $view_settings];
    return $output;
  }

}
