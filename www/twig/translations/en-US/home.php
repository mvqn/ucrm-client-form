<?php
/**
 * Localization file template in English (United States).
 *
 * @author Ryan Spaeth <rspaeth@mvqn.net>
 */

$translations = include_once __DIR__."/common.php";

// This will populate the head's <title> tag.
$translations["PAGE_TITLE"]                             = "Compact Page Example";

$translations["PAGE_DEMO_MODE"]                         = "This site is currently in demo mode.";
$translations["PAGE_INSTRUCTIONS_HEADER"]               = "Instructions";
$translations["PAGE_INSTRUCTIONS"]                      = [
                                                              "At any time, you can set the UCRM URL, UCRM App Key or ".
                                                              "Language.",
                                                              "Clicking the Apply button will set these as site-wide ".
                                                              "cookies for this browser and will allow you to use any ".
                                                              "of the pages here that require submission to a working ".
                                                              "UCRM system or have supported translations."
                                                          ];

$translations["PROJECT_HEADER"]                         = "Projects";
$translations["PROJECT_CRF_HEADER"]                     = "Customer Registration Form";
$translations["PROJECT_CRF_DETAILS"]                    = [
                                                              "A stand-alone set of PHP, HTML, JS and CSS for use on ".
                                                              "a dedicated company website."
                                                          ];
$translations["PROJECT_CRF_DOWNLOADS"]                  = [
                                                              ""
                                                          ];
$translations["PROJECT_CRF_PLUGINS"]                    = [
                                                              "plugin-notifier" => "https://github.com/mvqn-ucrm/".
                                                              "plugin-notifier/raw/master/plugin-notifier.zip",
                                                          ];


// TODO: Add other localization values as needed...

// Return the collection of translations!
return $translations;

