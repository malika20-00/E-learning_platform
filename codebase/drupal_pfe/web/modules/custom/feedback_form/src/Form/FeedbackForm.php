<?php
/**
 * @file
 * Contains \Drupal\hello_world\Form\HelloForm.
 */
namespace Drupal\feedback_form\Form;
use Drupal\node\Entity\Node;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\Response;

class FeedbackForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'feedback_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['description'] = [
      '#type' => 'label',
      '#markup' => $this->t('feedback'),
      '#attributes' => ['id' => ['title-class']]
    ];
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
//      '#description' => $this->t('Enter the title for your feedback. Note that the title must be at least 10 characters in length.'),
      '#required' => TRUE,
      '#attributes' => ['id' => ['first-class']],
    ];
    $form['feedback'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Feedback'),
//      '#description' => $this->t('Enter the your feedback. Note that the feedback must be at least 1 characters in length.'),
      '#required' => TRUE,
      '#attributes' => ['id' => ['second-class']],
    ];


    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $feedbackNode = Node::create([
      'type' => 'feedback',
      'title' => $form_state->getValue('title'),
      'body' => $form_state->getValue('feedback')
    ]);

    $feedbackNode->save();
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);

    $title = $form_state->getValue('title');
    $feedback = $form_state->getValue('feedback');

    if (strlen($title) < 10) {
      $form_state->setErrorByName('title', $this->t('The title must be at least 10 characters long.'));
    }

    if (strlen($feedback)<100){
      $form_state->setErrorByName('feedback', $this->t('The feedback must be at least 10 characters long.'));
    }

  }
}
