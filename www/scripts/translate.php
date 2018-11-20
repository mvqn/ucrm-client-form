<?php
declare(strict_types=1);

require_once __DIR__."/../vendor/autoload.php";

if(!array_key_exists(1, $argv))
    die("A locale must be provided! (i.e. en-US, es-ES, etc.)");

$locale = $argv[1];

use MVQN\Localization\Translator;

Translator::setTranslationDirectory(__DIR__."/../translations/");

if(!Translator::isSupportedLocale($locale))
    echo "The locale '$locale' should be added to the list of supported locales!\n";

Translator::setCurrentLocale($locale, true);


Translator::teach("Home", "");
Translator::teach("Projects", "");
Translator::teach("Customer Request Form", "");
Translator::teach("Full Page", "");
Translator::teach("Compact", "");
Translator::teach("Stepped", "");
Translator::teach("Requires", "");
Translator::teach("Apply", "");

Translator::teach("Requires", "");

Translator::teach("Compact Page Example", "");


Translator::teach("Service Type", "");
Translator::teach("Commercial", "");
Translator::teach("Residential", "");

Translator::teach("Contact", "");
Translator::teach("Company Name", "");
Translator::teach("First Name", "");
Translator::teach("Last Name", "");
Translator::teach("Email Name", "");
Translator::teach("Your email will never be shared with anyone.", "");
Translator::teach("Phone", "");

Translator::teach("Address", "");
Translator::teach("Address Line 1", "");
Translator::teach("Street address, P.O. Box, company name, c/o, etc.", "");
Translator::teach("Address Line 2", "");
Translator::teach("Apartment, suite, unit, floor, etc.", "");
Translator::teach("City / Town", "");
Translator::teach("State / Province / Region", "");
Translator::teach("Zip / Postal Code", "");
Translator::teach("Country", "");

Translator::teach("Geocode", "");
Translator::teach("Locate", "");
Translator::teach("Latitude", "");
Translator::teach("Longitude", "");
Translator::teach("After entering your address above, click the \"Locate\" button below and then please be sure to ".
    "position the marker as close as possible to your desired service location.", "");
Translator::teach("Done", "");

Translator::teach("Terms of Service", "");
Translator::teach("By clicking the button below, you hereby indicate that you have read and agree to the ", "");
Translator::teach("Sign-Up", "");
Translator::teach("Thank you for your submission, a sales representative will contact you soon!", "");
Translator::teach("Something went wrong during the submission process, we apologize for the inconvenience.<br/>".
    "Please feel free to contact us by phone!", "");



