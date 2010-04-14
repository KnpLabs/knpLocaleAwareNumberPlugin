<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormInput represents an HTML text input tag.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfWidgetFormInputText.class.php 20941 2009-08-08 14:11:51Z Kris.Wallsmith $
 */
class knpWidgetLocaleAwareNumber extends sfWidgetFormInputText
{
  public function convertToLocaleNumber($value)
  {
    $localeInfo = localeconv(); 
    $value = str_replace('.', $localeInfo['mon_decimal_point'], $value); 
    return $value;
  }
  
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $value = $this->convertToLocaleNumber($value);
    return parent::render($name, $value, $attributes, $errors);
  }
  
}
