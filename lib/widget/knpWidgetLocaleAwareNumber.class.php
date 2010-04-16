<?php

/**
 * sfWidgetFormInput represents an HTML text input tag.
 *
 * @package    knpLocaleAwareNumber
 * @subpackage widget
 * @author     Matthieu Bontemps <matthieu@knpLabs.com>
 */
class knpWidgetLocaleAwareNumber extends sfWidgetFormInputText
{
  
  /**
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);

    $this->addRequiredOption('format');
  }
  
  protected function convertToLocaleNumber($value)
  {
    $format = $this->getOption('format');
    $value = str_replace('.', $format->getDecimalSeparator(), $value); 
    return $value;
  }
  
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $value = $this->convertToLocaleNumber($value);
    return parent::render($name, $value, $attributes, $errors);
  }
  
}
