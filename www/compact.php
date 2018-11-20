<?php
/**
 * Displays our Client Form as a compact full page.
 *
 * @author Ryan Spaeth <rspaeth@mvqn.net>
 */

require_once __DIR__."/common.php";

//$translations = include_once __DIR__ . "/twig/translations/$language/compact.php";

// Render the appropriate template!
echo $twig->render("compact.html.twig",
[
    "config" => $config,
    "language" => $language,
    "translations" => $translations,
    "supportedLocales" => $supportedLocales,
    "query" => $query,
    "cookies" => $_COOKIE
]);
