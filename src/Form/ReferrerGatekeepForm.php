<?php

namespace Drupal\referrer_gatekeep\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;




class ReferrerGatekeepForm extends FormBase {

  protected function getEditableConfigNames() {
    return [
      'referrer_gatekeep.adminsettings',
    ];
  }

  public function getFormId() {
    return 'referrer_gatekeep_get_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('referrer_gatekeep.adminsettings');

    $form['input'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Input'),
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
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $file = 'referrer.txt';
//    $actual_link = "http://$_SERVER[HTTP_HOST]";
//    file_put_contents($file, $actual_link);
    file_put_contents($file, $form_state->getValue('input'));
    $this->messenger()->addMessage("Saved.");
  }

}