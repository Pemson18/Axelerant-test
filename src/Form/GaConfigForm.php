<?php
namespace Drupal\custom\axetest\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
* Class GaConfigForm.
*/
class GaConfigFormForm extends ConfigFormBase
{
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return [
     'ga.config',
   ];
    }
    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'ga_config';
    }
    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $config = $this->config('ga.config');
        $form['ga'] = array(
     '#type' => 'details',
     '#title' => $this->t('Add the GA Tag'),
     '#open' => true,
   );
        $form['ga']['tagval'] = [
    '#type' => 'select',
    '#title' => $this->t('Tag Value'),
    '#default_value' => $config->get('tagval'),
    '#options' => [
      '1' => $this
        ->t('Default'),
      '2' => $this
          ->t('Custom'),
    ],
    '#maxlength' => null,
];
        $form['ga']['tagdef'] = [
     '#type' => 'textarea',
     '#title' => $this->t('Tag Definition'),
     '#default_value' => $config->get('tagdef'),
     '#maxlength' => null,
];
        $form['ga']['paths']['#states'] = [
  'invisible' => [
    ['select[name="tagval"]' => ['value' => '1']],
  ],

  ];
        return parent::buildForm($form, $form_state);
    }
 
    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        parent::submitForm($form, $form_state);
        $this->config('ga.config')
   ->set('tagval', $form_state->getValue('tagval'))
   ->save();
        $this->config('ga.config')
     ->set('tagdef', $form_state->getValue('tagdef'))
     ->save();
    }
}
