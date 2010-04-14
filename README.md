# knpValidatorLocaleAwareNumber

## Usage

    $validator = new knpValidatorLocaleAwareNumber(array('locale' => 'fr_FR'));
    echo $validator->clean("2,5"); // 2.5
    
## Options

Available options:

* min: The minimum value allowed
* max: The maximum value allowed
* locale: The locale to use to validate the input. Will use the current locale by default.

