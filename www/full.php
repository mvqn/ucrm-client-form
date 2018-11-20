<?php
/**
 * Displays our Client Form as a full page.
 *
 * @author Ryan Spaeth <rspaeth@mvqn.net>
 */

require_once __DIR__."/common.php";

$translations = include_once __DIR__ . "/twig/translations/$language/full.php";

// Render the appropriate template!
echo $twig->render("full.html.twig",
[
    "config" => $config,
    "translations" => $translations,
    "query" => $query,
    "cookies" => $_COOKIE
]);