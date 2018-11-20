<?php
/**
 * Bootstrap the configuration and setup the TWIG environment.
 *
 * @author Ryan Spaeth <rspaeth@mvqn.net>
 */

require_once __DIR__."/vendor/autoload.php";

use MVQN\Localization\Translator;

// Load any user provided ENV variables from the ".env" file.
$env = new \Dotenv\Dotenv(__DIR__);
$env->load();

// Generate a configuration from environment variables, an ".env" file or overridden by the "config.php" file.
$config = include("config.php");

// Create and load the bare minimum TWIG environment...
$loader = new Twig_Loader_Filesystem(__DIR__."/twig/");
$twig = new Twig_Environment($loader);

Translator::setTranslationDirectory(__DIR__."/translations/");

$translate = new Twig_SimpleFunction("file_exists", function(Twig_Environment $env, string $path)
{
    /** @var Twig_Loader_Filesystem $loader */
    $loader = $env->getLoader();
    $loaderPaths = $loader->getPaths();

    foreach($loaderPaths as $loaderPath)
        if(file_exists($loaderPath."/".$path))
            return true;

    return false;
}, [ "needs_environment" => true ]);


$twig->addFilter(Translator::getTwigFilterTranslate());
$twig->addFunction($translate);