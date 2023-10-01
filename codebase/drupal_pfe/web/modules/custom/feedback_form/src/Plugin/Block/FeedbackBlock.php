<?php
namespace Drupal\feedback_form\Plugin\Block;
use Drupal\Core\Block\BlockBase;

/**
 * @Block(
 *   id = "feedback_block",
 *   admin_label = @Translation(" feedback block"),
 *   category = @Translation(" feedback block")
 * )
 */
class FeedbackBlock extends BlockBase
{
  /**
   * {@inheritdoc}
   */
  public function build()
  {
return \Drupal::formBuilder()->getForm('Drupal\feedback_form\Form\FeedbackForm');
    return $form;

  }
}
