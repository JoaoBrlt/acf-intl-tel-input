(function($) {

	// Initialize cookies in no conflict mode.
	let $acf_intl_tel_input_cookies = Cookies.noConflict();

	/**
	 *  initialize_field
	 *
	 *  This function will initialize the $field.
	 *
	 *  @date   30/11/17
	 *  @since  5.6.5
	 *
	 *  @return n/a
	 *  @param  $field
	 */

	function initialize_field( $field ) {

		// Field.
		const $phoneInput = $field.find('input[type=tel]');

		// Hidden field.
		const $hiddenName = $phoneInput.attr('data-hiddenInput');
		const $hiddenInput = $('input[name=acf\\[' + $hiddenName + '\\]]');

		// Field attributes.
		const $allowDropdown = $phoneInput.attr('data-allowDropdown');
		const $excludeCountries = $phoneInput.attr('data-excludeCountries');
		const $initialCountry = $phoneInput.attr('data-initialCountry');
		const $onlyCountries = $phoneInput.attr('data-onlyCountries');
		const $placeholderNumberType = $phoneInput.attr('data-placeholderNumberType');
		const $preferredCountries = $phoneInput.attr('data-preferredCountries');
		const $separateDialCode = $phoneInput.attr('data-separateDialCode');

		// Field options.
		const $phoneOptions = {
			allowDropdown: ($allowDropdown === '1'),
			autoPlaceholder: "aggressive",
			excludeCountries: ($excludeCountries !== '') ? $excludeCountries.split(',') : '',
			initialCountry: $initialCountry,
			onlyCountries: ($onlyCountries !== '') ? $onlyCountries.split(',') : '',
			placeholderNumberType: $placeholderNumberType,
			preferredCountries: ($preferredCountries !== '') ? $preferredCountries.split(',') : '',
			separateDialCode: ($separateDialCode === '1'),
		};

		// Geographical IP lookup.
		if ($initialCountry === 'auto') {
			$phoneOptions.geoIpLookup = function(callback) {
				// Check if we have user location saved in cookies.
				const $countryCodeCookie = $acf_intl_tel_input_cookies.get('acf_intl_tel_input_countryCode');
				if ($countryCodeCookie === undefined) {
					// If location is not saved, let's get it!
					$.get('https://ipinfo.io', function() {}, 'jsonp').always(function(resp) {
						const countryCode = (resp && resp.country) ? resp.country : '';

						// Save location to cookies.
						$acf_intl_tel_input_cookies.set('acf_intl_tel_input_countryCode', countryCode, {
							expires: 7,
							path: $acf_intl_tel_input_cookies.COOKIEPATH,
							domain: $acf_intl_tel_input_cookies.COOKIE_DOMAIN
						});

						// Execute the callback.
						callback(countryCode);
					});
				} else {
					// Execute the callback.
					callback($countryCodeCookie);
				}
			};
		}

		// Field focus out event.
		$phoneInput.on('blur', function() {
			// Check if the phone is valid.
			if ($phoneInput.intlTelInput("isValidNumber")) {
				// Get phone in both formats.
				const phone = $phoneInput.intlTelInput('getNumber', intlTelInputUtils.numberFormat.E164);
				const nationalPhone = $phoneInput.intlTelInput('getNumber', intlTelInputUtils.numberFormat.NATIONAL);

				// Create phone object.
				const phoneObject = {
					phone,
					nationalPhone
				};

				// Update the fields.
				$phoneInput.intlTelInput('setNumber', phone);
				$hiddenInput.val(JSON.stringify(phoneObject));
			} else {
				// Clear the fields.
				$phoneInput.val('');
				$hiddenInput.val('');
			}
		});

		// Initialize the input.
		$phoneInput.intlTelInput($phoneOptions);

	}


	if ( typeof acf.add_action !== 'undefined' ) {

		/*
		 *  ready & append (ACF5)
		 *
		 *  These two events are called when a field element is ready for initizliation.
		 *  - ready: on page load similar to $(document).ready()
		 *  - append: on new DOM elements appended via repeater field or other AJAX calls
		 *
		 *  @param	n/a
		 *  @return	n/a
		 */

		acf.add_action('ready_field/type=intl_tel_input', initialize_field);
		acf.add_action('append_field/type=intl_tel_input', initialize_field);

	}

})(jQuery);
