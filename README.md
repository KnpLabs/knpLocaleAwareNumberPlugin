# knpLocaleAwareNumber

knpLocaleAwareNumber is a symfony 1.4 package which deals with locale aware numbers (ie 2,6 in french // 2.6 in english).
It aims to provide both a validator and a widget.

## knpValidatorLocaleAwareNumber

### Usage

    setlocale(LC_ALL, 'fr_FR');
    $validator = new knpValidatorLocaleAwareNumber();
    echo $validator->clean("2,5"); // 2.5
    
## knpWidgetLocaleAwareNumber

## Usage

    $widget->render('knpLabs', '9.3') 
    // <input type="text" name="knpLabs" value="9,3" id="knpLabs" />