<?php
/**
 * Localization file template in English (United States).
 *
 * @author Ryan Spaeth <rspaeth@mvqn.net>
 */

$translations = include_once __DIR__."/common.php";

// This will populate the head's <title> tag.
$translations["PAGE_TITLE"]                             = "Compact Page Example";

// These translations are for the form fields and
// their content.
$translations["FORM_TITLE"]                             = "Formulario de solicitud de Cliente";

$translations["FORM_FIELD_SERVICE_TYPE"]                = "Service Type";
$translations["FORM_FIELD_SERVICE_TYPE_COMMERCIAL"]     = "Commercial";
$translations["FORM_FIELD_SERVICE_TYPE_RESIDENTIAL"]    = "Residential";

$translations["FORM_FIELD_CONTACT"]                     = "Contact";
$translations["FORM_FIELD_CONTACT_COMPANY_NAME"]        = "Company Name";
$translations["FORM_FIELD_CONTACT_FIRST_NAME"]          = "First Name";
$translations["FORM_FIELD_CONTACT_LAST_NAME"]           = "Last Name";
$translations["FORM_FIELD_CONTACT_EMAIL"]               = "Email";
$translations["FORM_FIELD_CONTACT_EMAIL_TOOLTIP"]       = "Your email will never be shared with anyone.";
$translations["FORM_FIELD_CONTACT_PHONE"]               = "Phone";

$translations["FORM_FIELD_ADDRESS"]                     = "Address";
$translations["FORM_FIELD_ADDRESS_LINE1_LABEL"]         = "Address Line 1";
$translations["FORM_FIELD_ADDRESS_LINE1_TOOLTIP"]       = "Street address, P.O. Box, company name, c/o, etc.";
$translations["FORM_FIELD_ADDRESS_LINE2_LABEL"]         = "Address Line 2";
$translations["FORM_FIELD_ADDRESS_LINE2_TOOLTIP"]       = "Apartment, suite, unit, floor, etc.";
$translations["FORM_FIELD_ADDRESS_CITY_LABEL"]          = "City / Town";
$translations["FORM_FIELD_ADDRESS_STATE_LABEL"]         = "State / Province / Region";
$translations["FORM_FIELD_ADDRESS_ZIP_LABEL"]           = "Zip / Postal Code";
$translations["FORM_FIELD_ADDRESS_COUNTRY_LABEL"]       = "Country";
$translations["FORM_FIELD_ADDRESS_LATITUDE"]            = "Latitude";
$translations["FORM_FIELD_ADDRESS_LONGITUDE"]           = "Longitude";

$translations["FORM_FIELD_LOCATE_BUTTON_LABEL"]         = "Locate";
$translations["FORM_FIELD_LOCATE_INSTRUCTIONS"]         = "After entering your address above, click the \"Locate\" ".
                                                          "button below and then please be sure to position the ".
                                                          "marker as close as possible to your desired service ".
                                                          "location.";
$translations["FORM_FIELD_LOCATE_DONE_BUTTON_LABEL"]    = "Done";

$translations["FORM_FIELD_TERMS_OF_SERVICE_LABEL"]      = "Terms of Service";
$translations["FORM_FIELD_TERMS_OF_SERVICE_AGREEMENT"]  = "By clicking the button below, you hereby indicate that you ".
                                                          "have read and agree to the";
$translations["FORM_FIELD_TERMS_OF_SERVICE_FULL_PATH"]  = "translations/".$translations["LANG_CODE"]."/tos.html";

$translations["FORM_FIELD_SUBMIT_BUTTON_LABEL"]         = "Sign-Up";

$translations["FORM_SUBMISSION_STATUS_SUCCESS"]         = "Thank you for your submission, a sales representative will ".
                                                          "contact you soon!";
$translations["FORM_SUBMISSION_STATUS_FAILURE"]         = "Something went wrong during the submission process, we ".
                                                          "apologize for the inconvenience.<br/>".
                                                          "Please feel free to contact us by phone!";

// TODO: Add other localization values as needed...

// Return the collection of translations!
return $translations;

