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

## Features

While this project started out as a simple "proof of concept" for interfacing end-user WISP admins with the ability to
embed a new customer request form and then automatically create a client lead in the UCRM system, it has certainly grown
beyond what was originally envisioned.

Some of the current features include:
- Stand-alone or template-driven embeddable form pages to suit most needs. 
- Google Maps Visualizer with draggable pin for precise location of customer service locations.
- Google Maps Layers to allow for KML/KMZ overlays.
- Email notification upon successful Client Lead creation in UCRM.

Some of the (possibly) planned upcoming features include:
- A "lite" client-side (HTML/CSS/JS ONLY) version for use in non-PHP driven sites.
- A "widget" version for popular CMS systems (i.e. WordPress, Joomla, Drupal, etc.). 
- A Single Page Application (SPA) version for frameworks like Angular, React and Vue.
- Inclusion of a heat-mapping system, given the availability of an AirLink API and features.
- Inclusion of a CAPTCHA style anti-spam system.
- A matching UCRM Plugin to host the scripts, KMZ/KML, images, etc. OR Client Zone Integration (when available).   

## Feature Requests

For the time being, feature requests should probably be handled through the issue system here on 
[Github](https://github.com/mvqn/ucrm-client-form/issues), but input and suggestions are also welcome on the
[UCRM Plugins](https://community.ubnt.com/t5/UCRM-Plugins/bd-p/UCRMPlugins/) forum.

## Screenshots

Full Page Layout

- [Full Page Layout](screenshots/full.jpg)
- [Compact Layout (Inputs)](screenshots/compact_01.jpg)
- [Compact Layout (Location)](screenshots/compact_02.jpg)


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