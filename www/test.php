<?php
declare(strict_types=1);

require_once __DIR__."/vendor/autoload.php";

use MVQN\Localization\Translator;
use MVQN\Localization\Locale;

Translator::setTranslationDirectory(__DIR__."/translations/");
Translator::setCurrentLocale(Locale::SPANISH_SPAIN);

Translator::teach("Hello", "Hola");
Translator::teach("good", "bueno");


echo Translator::translate("Good")."\n";
echo Translator::translate("hello")."\n";


echo Translator::isSupportedLocale("es-ES") ? "Y" : "N";
