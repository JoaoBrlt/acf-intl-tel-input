# Advanced Custom Fields: International Telephone Input

Adds International Telephone Input to ACF.

## Requirements
* [Advanced Custom Fields 5](https://www.advancedcustomfields.com/)
* [Wordpress 4.7](https://wordpress.org/) or higher
* [PHP 5.4](https://www.php.net/) or higher

## Installation

1. Copy the `acf-intl-tel-input` folder into your `wp-content/plugins` folder.
2. Activate the International Telephone Input plugin via the plugins admin page.
3. Create a new field via ACF and select the International Telephone Input type.
4. Read the description below for usage instructions.

## Options

Note: All country codes must be [ISO 3166-1 alpha-2](http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2) codes

**allowDropdown**

Type: `Boolean`
Default: `true`

Whether to allow the country dropdown.

**initialCountry**

Type: `String` 
Default: `"auto"`

Set the initial country selection by specifying its country code.
You can also set it to `"auto"`, which will lookup the user's country based on their IP address.

**onlyCountries**

Type: `String`
Default: `""`

Display only the countries you specify in the dropdown.

**placeholderNumberType**

Type: `String`
Default: `"MOBILE"`

Set the number type to use for the placeholder.
You can set it to `"MOBILE"` to use a mobile phone format, or you can set it to `"FIXED_LINE"` to use a fixed line phone format.

**preferredCountries**

Type: `String`
Default: `""`

Set the countries that should appear at the top in the dropdown.

**separateDialCode**

Type: `Boolean`
Default: `false`

Display the country dial code next to the selected flag, so it's not part of the typed number.

## Example

```php
$phone_field = [
	
	/* ... Insert generic settings here ... */

	'type' => 'intl_tel_input',
	'allowDropdown' => true,
	'initialCountry' => 'FR',
	'onlyCountries' => '',
	'placeholderNumberType' => 'FIXED_LINE',
	'preferredCountries' => 'FR, ES, PT, IT, DE',
	'separateDialCode' => false,
	'required' => false
	
];
```

## Links

- [International Telephone Input](https://github.com/jackocnr/intl-tel-input)
- [JavaScript Cookie](https://github.com/js-cookie/js-cookie) 

## Contributors

- [Jony Hayama](https://github.com/jonyhayama)
- [Alejandro Lucena](https://github.com/aluckyar)
- [Peter Wise](https://github.com/petertwise)
- [Joao Brilhante](https://github.com/JoaoBrlt)

## License

This project is licensed under the GPLv3 License - see the [LICENSE.md](LICENSE.md) file for details.