<?php

namespace Drupal\referrer_gatekeep\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\State\State;


class ReferrerGatekeepForm extends FormBase
{

  protected function getEditableConfigNames()
  {
    return [
      'referrer_gatekeep.development',
    ];
  }

  public function getFormId()
  {
    return 'referrer_gatekeep_get_form';
  }





  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $config = $this->config('referrer_gatekeep.development');

    $form['from'] = array(
      '#type' => 'item',
      '#title' => t('The current stored link:'),
      '#markup' => '<div>' . \Drupal::state()->get('ref') . '</div>'
    );

    $form['input'] = [
      '#type' => 'textfield',
      '#description' => $this->t('Link to a desired referer website.'),
      '#default_value' => \Drupal::state()->get('ref'),
    ];

    $form['input2'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Absolute link to a desired redirect target.'),
      '#default_value' => \Drupal::state()->get('red_target'),
    ];

    $form['input1'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Redirect message'),
      '#default_value' => \Drupal::state()->get('ref_message'),
    ];



    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Submit',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    \Drupal::state()->set('ref', $form_state->getValue('input'));
    \Drupal::state()->set('ref_message', $form_state->getValue('input1'));
    \Drupal::state()->set('red_target', $form_state->getValue('input2'));
    $this->messenger()->addMessage("Saved.");
  }
}
