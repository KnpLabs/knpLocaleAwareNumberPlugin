# knpLocaleAwareNumber

knpLocaleAwareNumber is a symfony 1.4 package which deals with locale aware numbers (ie 2,6 in french // 2.6 in english).
It aims to provide both a validator and a widget.

Both use a 'format' option (a sfNumberFormatInfo) which defines how numeric values are formatted and displayed. By default, knpLocaleAwareNumber uses the current sfNumberFormatInfo instance (associated to the current culture).

## knpValidatorLocaleAwareNumber

### Usage

    $validator = new knpValidatorLocaleAwareNumber();
    echo $validator->clean("2,5"); // 2.5

    // This is equivalent to:
    
    $validator = new knpValidatorLocaleAwareNumber(array('format' => sfNumberFormatInfo::getInstance()));
    echo $validator->clean("2,5"); // 2.5
    
## knpWidgetLocaleAwareNumber

## Usage

    $widget->render('knpLabs', '9.3') 
    // <input type="text" name="knpLabs" value="9,3" id="knpLabs" />