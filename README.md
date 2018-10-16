# mvqn/ucrm-client-form
A simple web form for use on stand-alone websites, where visitors can register and UCRM Client leads can be
automatically generated.

## Installation
This is a stand-alone set of HTML, CSS and JS files that may need to be slightly modified for individual environments.


## Documentation

1. Copy all files and folders from the `www` folder into a PHP enabled web server folder.
2. Change permissions/ownership, as needed.
3. Edit the config.php file accordingly.
4. Enjoy! 

## Screenshots
- [Full Page Layout](screenshots/full.jpg)


## About

### Requirements
- Built and tested for PHP 7+, but will likely run on older versions. 
- All other requirements are managed by composer (back-end) and yarn (front-end).

### Third-Party Libraries

#### Frontend Libraries
- [jQuery](https://jquery.org/) For all DOM manipulations, including Maps API.
- [jQuery Validation](https://jqueryvalidation.org/) For all validation mechanisms.
- [Bootstrap](https://getbootstrap.com/) For layouts, including modal dialogs.
- [FontAwesome](https://fontawesome.com/) Used for a couple icons.
- [Google Maps API](https://developers.google.com/maps/documentation/) Used by mapping system.

#### Backend Libraries
- [Twig](https://twig.symfony.com/) For examples using Twig templating.
- [PHPMailer](https://github.com/PHPMailer/PHPMailer) Used by the email notification system.
- [PhpDotEnv](https://github.com/vlucas/phpdotenv) For environment variables during development.


### Submitting bugs and feature requests
Bugs and feature request are tracked on [Github](https://github.com/mvqn/ucrm-client-form/issues)

### Author
Ryan Spaeth <[rspaeth@mvqn.net](mailto:rspaeth@mvqn.net)>

### License
This code is licensed under the MIT License - see the [LICENSE](/LICENSE) file for details.

### Acknowledgements
Thanks to the Ubiquiti Team for their UCRM system and regular improvements of their API.