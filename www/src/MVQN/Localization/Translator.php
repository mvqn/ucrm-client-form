<?php
declare(strict_types=1);

namespace MVQN\Localization;



use MVQN\Localization\Exceptions\TranslatorException;

final class Translator
{
    private const JSON_OPTIONS = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT;

    private const TEACHING_LOCALE = Locale::ENGLISH_UNITED_STATES;


    private static $translationDirectory;

    public static function getTranslationDirectory(): string
    {
        if(self::$translationDirectory === null || self::$translationDirectory === "")
            throw new TranslatorException("No translation directory has been set!\n");

        if(realpath(self::$translationDirectory) === false)
            throw new TranslatorException("The translation directory '".self::$translationDirectory."' is missing!\n");

        return self::$translationDirectory;
    }

    public static function setTranslationDirectory(string $directory): void
    {
        if(!file_exists($directory))
            mkdir($directory, 0775, true);

        if(realpath($directory) === false)
            throw new TranslatorException("An invalid translation directory was provided '$directory'!\n");

        self::$translationDirectory = realpath($directory);
    }




    private static $supportedLocales;

    public static function getSupportedLocales(): array
    {
        if(self::$supportedLocales === null || self::$supportedLocales === [])
        {
            $reflection = new \ReflectionClass(Locale::class);
            self::$supportedLocales = $reflection->getConstants();
        }

        return self::$supportedLocales;
    }

    public static function isSupportedLocale(string $locale): bool
    {
        return (array_search($locale, array_values(self::getSupportedLocales()), true) !== false);
    }

    public static function isTeachingLocale(string $locale): bool
    {
        return ($locale === self::TEACHING_LOCALE);
    }



    private static $currentLocale;

    public static function getCurrentLocale(): string
    {
        if(self::$currentLocale === null || self::$currentLocale === "")
            //throw new TranslatorException("No locale has been set!\n");
            self::$currentLocale = self::TEACHING_LOCALE;

        return self::$currentLocale;
    }

    public static function setCurrentLocale(string $locale, bool $force = false): void
    {
        if($locale === null || $locale === "")
            throw new TranslatorException("An invalid locale was provided '$locale'!\n");

        if(!$force && !self::isSupportedLocale($locale))
            throw new TranslatorException("The locale '$locale' is not currently supported!\n");

        self::$currentLocale = $locale;
    }



    public static function getLocaleFile(string $locale): string
    {
        $locale = self::getCurrentLocale();
        $directory = self::getTranslationDirectory();
        $localeFile = "$directory/$locale.json";

        if(!file_exists($localeFile))
            file_put_contents($localeFile, "{}");

        if(realpath($localeFile) === false)
            throw new TranslatorException("The locale file '$localeFile' could not be created!\n");

        return realpath($localeFile);
    }



    public static function clear(): bool
    {
        $localeFile = self::getLocaleFile(self::getCurrentLocale());

        if(file_exists($localeFile))
        {
            file_put_contents($localeFile, "{}");
            return true;
        }

        return false;
    }


    public static function teach(string $text, string $translation): bool
    {
        if(self::isTeachingLocale(self::getCurrentLocale()))
            return false;

        $localeFile = self::getLocaleFile(self::getCurrentLocale());

        $dictionary = json_decode(file_get_contents($localeFile), true) ?: [];

        if(array_key_exists($text, $dictionary) && $dictionary[$text] === $translation)
            return false;

        $dictionary[$text] = $translation;
        file_put_contents($localeFile, json_encode($dictionary, self::JSON_OPTIONS));
        return true;
    }

    public static function getTranslations(): array
    {
        if(self::isTeachingLocale(self::getCurrentLocale()))
            return [];

        $localeFile = self::getLocaleFile(self::getCurrentLocale());

        $dictionary = json_decode(file_get_contents($localeFile), true) ?: [];

        return $dictionary;
    }


    public static function translate(string $text): ?string
    {
        if(self::isTeachingLocale(self::getCurrentLocale()))
            return $text;

        $localeFile = self::getLocaleFile(self::getCurrentLocale());

        $dictionary = json_decode(file_get_contents($localeFile), true) ?: [];

        if(array_key_exists($text, $dictionary))
            return $dictionary[$text];

        $isCapitalized = preg_match("/^[A-Z]/", $text);

        if($isCapitalized && array_key_exists(lcfirst($text), $dictionary))
            return ucfirst($dictionary[lcfirst($text)]);

        if(!$isCapitalized && array_key_exists(ucfirst($text), $dictionary))
            return lcfirst($dictionary[ucfirst($text)]);

        // TODO: Add other fancier checks as needed!

        return null;
    }







    public static function getTwigFilterTranslate(): \Twig_Filter
    {
        return new \Twig_Filter("translate", function(string $text, string $locale = "")
        {
            if($locale !== "" && Translator::isSupportedLocale($locale))
                Translator::setCurrentLocale($locale);

            $translated = Translator::translate($text);

            if($translated === null)
                Translator::teach($text, $text);

            return Translator::translate($text);
        });
    }




}