<?php
/**
 * bootstrap.php
 *
 * Bootstrap the configuration and setup the TWIG environment.
 *
 * @author Ryan Spaeth <rspaeth@mvqn.net>
 */

require_once __DIR__."/vendor/autoload.php";

// Load any user provided ENV variables from the ".env" file.
$env = new \Dotenv\Dotenv(__DIR__."/../");
$env->load();

// Generate a configuration from environment variables, an ".env" file or overridden by the "config.php" file.
$config = include("config.php");

// Create and load the bare minimum TWIG environment...
$loader = new Twig_Loader_Filesystem(__DIR__."/twig/");
$twig = new Twig_Environment($loader);

