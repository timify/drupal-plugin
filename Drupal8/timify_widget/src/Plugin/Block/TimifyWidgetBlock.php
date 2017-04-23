<?php

namespace Drupal\timify_widget\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Timify Widget' Block.
 *
 * @Block(
 *   id = "timify_widget",
 *   admin_label = @Translation("Timify Widget"),
 * )
 */
class TimifyWidgetBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $timifyWidgetId           = \Drupal::config('timify_widget.settings.form')->get('timify_widget_id');
    $timifyWidgetLanguage     = \Drupal::config('timify_widget.settings.form')->get('timify_widget_language');
    $timifyWidgetPosition     = \Drupal::config('timify_widget.settings.form')->get('timify_widget_position');
    $timifyWidgetButtonLabel  = \Drupal::config('timify_widget.settings.form')->get('timify_widget_button_label');

    if ($timifyWidgetId != '' && $timifyWidgetPosition == 'as_block') {

      if ($timifyWidgetButtonLabel == '' || $timifyWidgetButtonLabel == null) {
        $timifyWidgetButtonLabel  = 'Book an appointment';
      }

      return [
        '#theme'                      => 'timify_widget_button',
        '#timify_id'                  => $timifyWidgetId,
        '#timify_widget_language'     => $timifyWidgetLanguage,
        '#timify_widget_position'     => $timifyWidgetPosition,
        '#timify_widget_button_label' => $timifyWidgetButtonLabel,
      ];
    }

    return array(
      '#markup'     => '',
    );
  }

}
