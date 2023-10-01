<?php
/**
 * @file
 * Contains \Drupal\exercise_form\Form\AddExerciceForm.
 */
namespace Drupal\Training\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Database\Database;
use Drupal\user\Form\UserLoginForm;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Core\Messenger\MessengerInterface;

class LoginForm extends UserLoginForm {
  /**
   * {@inheritdoc}
   */
  public function getFormId(): string
  {
    return 'LoginForm';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Enter your email'),
      '#required' => TRUE,
    ];

    $form['student_dob'] = array (
      '#type' => 'password',
      '#title' => t('Enter your password:'),
      '#required' => TRUE,
    );
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    ];
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->messenger->addMessage('Email: '.$form_state->getValue('email'));
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
    $email = $form_state->getValue('email');

    if (strlen($email) < 10) {
      // Set an error for the form element with a key of "title".
      $form_state->setErrorByName('email', $this->t('The email must be at least 10 characters long.'));
    }

  }
}
