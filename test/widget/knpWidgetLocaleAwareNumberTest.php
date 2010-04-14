<?php

require_once dirname(__FILE__).'/../bootstrap.php';
require_once dirname(__FILE__).'/../../lib/widget/knpWidgetLocaleAwareNumber.class.php';

$t = new lime_test(1);
$v = new knpWidgetLocaleAwareNumber();


// ->render()
$t->diag('->render()');

$nb = clone sfNumberFormatInfo::getInstance();
$nb->setDecimalSeparator(',');

$widget = new knpWidgetLocaleAwareNumber(array(
  'format' => $nb,
));
$t->is($widget->render('id', '9.3'), '<input type="text" name="id" value="9,3" id="id" />', '9.3 is rendered as 9,3');