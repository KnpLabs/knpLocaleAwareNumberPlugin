<?php

require_once dirname(__FILE__).'/../bootstrap.php';
require_once dirname(__FILE__).'/../../lib/widget/knpWidgetLocaleAwareNumber.class.php';

$t = new lime_test(1);


// ->render()
$t->diag('->render()');

$format = clone sfNumberFormatInfo::getInstance();
$format->setDecimalSeparator(',');

$widget = new knpWidgetLocaleAwareNumber(array(
  'format' => $format,
));
$t->is($widget->render('id', '9.3'), '<input type="text" name="id" value="9,3" id="id" />', '9.3 is rendered as 9,3');