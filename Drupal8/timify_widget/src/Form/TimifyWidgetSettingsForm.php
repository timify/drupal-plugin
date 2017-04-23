<?php
/**
 * @file
 * Contains \Drupal\timify_widget\src\Form\TimifyWidgetSettingsForm.
 */

namespace Drupal\timify_widget\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

/**
 * Configure custom settings for this site.
 */
class TimifyWidgetSettingsForm extends ConfigFormBase {

  /**
   * Constructor for TimifySettingsForm.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   * The factory for configuration objects.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    parent::__construct($config_factory);
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'timify_widget_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['timify_widget.settings.form'];
  }

  /**
   * Form constructor.
   *
   * @param array $form
   * An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   * The current state of the form.
   *
   * @return array
   * The form structure.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $timifyWidget             = $this->config('timify_widget.settings.form');

    $form['timify_widget_id'] = [
      '#type'           => 'textfield',
      '#title'          => $this->t('Your Timify ID'),
      '#description'    => $this->t("Fill here your Timify ID."),
      '#default_value'  => $timifyWidget->get('timify_widget_id'),
      '#required'       => TRUE,
    ];

    $form['timify_widget_language'] = [
      '#type'           => 'select',
      '#title'          => $this->t('Language'),
      '#default_value'  => $timifyWidget->get('timify_widget_language') ? $timifyWidget->get('timify_widget_language') : 'en',
      '#options'        => array(
        'de'			         => 'Deutschland',
        'en'			         => 'English',
        'ee'			         => 'Eesti',
        'es'			         => 'España',
        'fr'			         => 'France',
        'hu'			         => 'Hungary',
        'it'			         => 'Italia',
        'nl'			         => 'Nederland',
        'ru'			         => 'Россия',
        'zh'			         => '台灣',
        'ph'			         => 'Philippines',
      ),
      '#description'    => $this->t('Choose a language for your timify booking widget.'),
      '#required'       => TRUE,
    ];

    $form['timify_widget_position'] = [
      '#type'           => 'select',
      '#title'          => $this->t('Position'),
      '#default_value'  => $timifyWidget->get('timify_widget_position') ? $timifyWidget->get('timify_widget_position') : 'left',
      '#options'        => array(
        'left'			       => $this->t('Left side'),
        'right'			       => $this->t('Right side'),
        'as_block'			   => $this->t('Use it as Block element'),
      ),
      '#description'    => $this->t('Specify position of the booking widget'),
      '#required'       => TRUE,
    ];

    $form['timify_widget_button_label'] = [
      '#type'           => 'textfield',
      '#title'          => $this->t('Label of the button'),
      '#default_value'  => $timifyWidget->get('timify_widget_button_label') ? $timifyWidget->get('timify_widget_button_label') : $this->t('Book an appointment'),
      '#description'    => $this->t('Specify label of the button. The button will be shown if the position is not in left or right side.'),
    ];

    // Submit button.
    $form['actions']            = ['#type' => 'actions'];
    $form['actions']['submit']  = [
      '#type'           => 'submit',
      '#value'          => $this->t('Save configuration'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   * An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   * The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('timify_widget.settings.form')
        ->set('timify_widget_id',           $form_state->getValue(array('timify_widget_id')))
        ->set('timify_widget_language',     $form_state->getValue(array('timify_widget_language')))
        ->set('timify_widget_position',     $form_state->getValue(array('timify_widget_position')))
        ->set('timify_widget_button_label', $form_state->getValue(array('timify_widget_button_label')))
        ->save();
    parent::submitForm($form, $form_state);
  }

}
