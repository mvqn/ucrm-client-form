<?php
/**
 * Displays our Client Form as a compact full page.
 *
 * @author Ryan Spaeth <rspaeth@mvqn.net>
 */

require_once __DIR__."/bootstrap.php";

use MVQN\Localization\Translator;
use MVQN\Localization\Locale;

$query = [];

if(array_key_exists("QUERY_STRING", $_SERVER))
{
    $parts = explode("&", $_SERVER["QUERY_STRING"]);

    foreach($parts as $part)
    {
        $kvp = explode("=", $part);
        $key = count($kvp) > 0 ? $kvp[0] : "";
        $value = count($kvp) > 1 ? $kvp[1] : "";

        if($key !== "")
            $query[$key] = $value;
    }
}

$language = $config["site"]["demo"] && array_key_exists("demoLanguage", $_COOKIE) ?
    $_COOKIE["demoLanguage"] :
    $config["site"]["lang"];

Translator::setCurrentLocale($language);

$translations = Translator::getTranslations();
$supportedLocales = [];

foreach(Translator::getSupportedLocales() as $const => $code)
{
    $name = Locale::name($code);
    $translated = Translator::translate($name);

    if($translated === null)
    {
        Translator::teach($name, $name);
        $translated = $name;
    }

    $supportedLocales[$code] = $translated;

}