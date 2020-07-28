=== Advanced Custom Fields: International Telephone Input Field ===
Contributors: João Brilhante, Jony Hayama, Peter Wise, Alejandro Lucena
Tags: acf, intl, tel, phone, telephone, input, field
Requires at least: 4.7
Tested up to: 5.4.2
Requires PHP: 5.4
Stable tag: trunk
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Adds International Telephone Input to ACF.

== Description ==

Adds International Telephone Input to ACF.

= Options =

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

= Example =

`
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
`

= Links =

- [International Telephone Input](https://github.com/jackocnr/intl-tel-input)
- [JavaScript Cookie](https://github.com/js-cookie/js-cookie)

= Contributors =

- [Jony Hayama](https://github.com/jonyhayama)
- [Alejandro Lucena](https://github.com/aluckyar)
- [Peter Wise](https://github.com/petertwise)
- [Joao Brilhante](https://github.com/JoaoBrlt)

== Installation ==

1. Copy the `acf-intl-tel-input` folder into your `wp-content/plugins` folder
2. Activate the International Telephone Input plugin via the plugins admin page
3. Create a new field via ACF and select the International Telephone Input type
4. Read the description above for usage instructions

== Changelog ==

= [1.2.2] =
* Fix - Fixed bug that appeared on new posts.

= [1.2.1] =
* i18n - Add the plugin translation template.
* i18n - Add the French (France) translation files.
* Fix - Fixed bug making multiple telephone inputs unusable.
* New - Support the `required`, `disabled` and `readonly` attributes.
* New - Add Editor Config file.

= 1.2.0 =
* New - Update the version of [International Telephone Input](https://github.com/jackocnr/intl-tel-input) to v17.0.0.
* New - Update the version of [JavaScript Cookie](https://github.com/js-cookie/js-cookie) to v2.2.1.
* New - Save phone as object (with the international phone and the national phone).
* New - Add the option to choose the placeholder number type.
* New - Add Composer compatibility.

= 1.1.0 =
* New - Add GitHub Updater compatibility.
* Fix - Bug fixes.

= 1.0.0 =
* Initial Release.
