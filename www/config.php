<?php

return [
    "ucrmServer" => "https://ucrm.dev.example.com",

    // The REST Client does not currently support HTTPS for the API calls.
    "ucrmApiUrl" => "http://ucrm.dev.example.com/api/v1.0",
    // Be sure the App key you generate is of type "Write" or the Client Lead generation will fail!
    "ucrmAppKey" => "",

    // Only Google Maps is currently supported!
    // You should be able use the same key that you are currently using in UCRM/UNMS.
    "mapsApiKey" => "",
    // Set a default Lat/Lon and zoom level to center on a specific area, if desired.  Defaults works just fine!
    "mapsStartingLatitude" => 0.0,
    "mapsStartingLongitude" => 0.0,
    // The higher the zoom number, the closer the view.
    "mapsStartingZoom" => 1,
];
