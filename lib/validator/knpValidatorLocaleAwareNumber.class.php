<?php

/**
* knpValidatorLocaleAwareNumber validates a number (integer or float) using the current locale. Useful if you want to use commas instead of dots.
*
* @package    knpLocaleAwareNumber
* @subpackage validator
* @author     Matthieu Bontemps <matthieu@knpLabs.com>
*/
class knpValidatorLocaleAwareNumber extends sfValidatorNumber
{
  /**
  * Configures the current validator.
  *
  * Available options:
  *
  *  * format: The symfony object which defines how numeric values are formatted and displayed.
  *
  * @param array $options   An array of options
  * @param array $messages  An array of error messages
  *
  * @see sfValidatorBase
  */
  protected function configure($options = array(), $messages = array())
  {
    $this->addRequiredOption('format');

    parent::configure();
  }

  /**
  * @see sfValidatorBase
  */
  protected function doClean($value)
  {
    $value = $this->convertToEnglishNumber($value);
    
    if (!preg_match('#^[\d\.]+$#', $value))
    {
      throw new sfValidatorError($this, 'invalid', array('value' => $value));
    }
    
    return parent::doClean($value);
  }

  public function convertToEnglishNumber($value)
  {
    $format = $this->getOption('format');
    $value = str_replace($format->getDecimalSeparator() , '.', $value); 
    return $value;
  }
}
