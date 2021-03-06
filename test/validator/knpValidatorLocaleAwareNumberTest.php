<?php

require_once dirname(__FILE__).'/../bootstrap.php';
require_once dirname(__FILE__).'/../../lib/validator/knpValidatorLocaleAwareNumber.class.php';

$t = new lime_test(13);

$formatDot = clone sfNumberFormatInfo::getInstance();
$formatDot->setDecimalSeparator('.');
$formatComma = clone sfNumberFormatInfo::getInstance();
$formatComma->setDecimalSeparator(',');

$v = new knpValidatorLocaleAwareNumber(array('format' => $formatDot));

// ->clean()
$t->diag('->clean()');

$t->is($v->clean("12.3"), 12.3, '->clean() with en_US returns the numbers unmodified');

$v->setOption('format', $formatComma);
$t->is($v->clean("12,3"), 12.3, '->clean() with fr_FR converts the strings to numbers');
$t->is($v->clean("12.3"), 12.3, '->clean() converts the strings to numbers − always works with english numbers');


try
{
  $v->clean('not a float');
  $t->fail('->clean() throws a sfValidatorError if the value is not a number');
}
catch (sfValidatorError $e)
{
  $t->pass('->clean() throws a sfValidatorError if the value is not a number');
}

$v->setOption('format', $formatDot);
try
{
  $v->clean('12,3');
  $t->fail('->clean() throws a sfValidatorError if the value is not a number in the current locale');
}
catch (sfValidatorError $e)
{
  $t->pass('->clean() throws a sfValidatorError if the value is not a number');
}

$v->setOption('format', $formatComma);

$v->setOption('required', false);
$t->ok($v->clean(null) === null, '->clean() returns null for null values');

$v->setOption('max', 2);
$t->is($v->clean('1,3'), "1.3", '->clean() checks the maximum number allowed');
try
{
  $v->clean("3,4");
  $t->fail('"max" option set the maximum number allowed');
}
catch (sfValidatorError $e)
{
  $t->pass('"max" option set the maximum number allowed');
}

$v->setMessage('max', 'Too large');
try
{
  $v->clean(5);
  $t->fail('"max" error message customization');
}
catch (sfValidatorError $e)
{
  $t->is($e->getMessage(), 'Too large', '"max" error message customization');
}

$v->setOption('max', null);

$v->setOption('min', 3);
$t->is($v->clean(5), 5, '->clean() checks the minimum number allowed');
try
{
  $v->clean('1');
  $t->fail('"min" option set the minimum number allowed');
  $t->skip('', 1);
}
catch (sfValidatorError $e)
{
  $t->pass('"min" option set the minimum number allowed');
  $t->is($e->getCode(), 'min', '->clean() throws a sfValidatorError');
}

$v->setMessage('min', 'Too small');
try
{
  $v->clean(1);
  $t->fail('"min" error message customization');
}
catch (sfValidatorError $e)
{
  $t->is($e->getMessage(), 'Too small', '"min" error message customization');
}

$v->setOption('min', null);
