<?php
/**
 * full.php
 *
 * Displays our Client Form as a full page.
 *
 * @author Ryan Spaeth <rspaeth@mvqn.net>
 */

require_once __DIR__."/bootstrap.php";

// Render the appropriate template!
echo $twig->render("compact.html.twig", [ "config" => $config ]);

