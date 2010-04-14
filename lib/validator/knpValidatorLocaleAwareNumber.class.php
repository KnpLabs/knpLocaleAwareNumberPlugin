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
  *  * max: The maximum value allowed
  *  * min: The minimum value allowed
  *
  * Available error codes:
  *
  *  * max
  *  * min
  *
  * @param array $options   An array of options
  * @param array $messages  An array of error messages
  *
  * @see sfValidatorBase
  */
  protected function configure($options = array(), $messages = array())
  {
    $this->addMessage('max', '"%value%" must be at most %max%.');
    $this->addMessage('min', '"%value%" must be at least %min%.');

    $this->addOption('min');
    $this->addOption('max');

    $this->setMessage('invalid', '"%value%" is not a number.');
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
    $localeInfo = localeconv(); 
    $value = str_replace($localeInfo['mon_decimal_point'] , '.', $value); 
    return $value;
  }
}
