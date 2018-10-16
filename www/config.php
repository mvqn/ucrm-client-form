<?php

return
[

    "ucrm" =>
    [
        "host" => getenv("UCRM_HOST") ?: "https://ucrm.dev.example.com",

        "rest" =>
        [
            // The REST Client does not currently support HTTPS for the API calls.
            "url" => getenv("UCRM_REST_URL") ?: "http://ucrm.dev.example.com/api/v1.0",

            // Be sure the App key you generate is of type "Write" or the Client Lead generation will fail!
            "key" => getenv("UCRM_REST_KEY") ?: "",
        ],
    ],

    "maps" =>
    [
        // Only Google Maps is currently supported!
        "google" =>
        [
            "api" =>
            [
                // You should be able use the same key that you are currently using in UCRM/UNMS.
                "key" => getenv("GOOGLE_MAPS_API_KEY") ?: "",
            ],

            "defaults" =>
            [
                // Set a default Lat/Lon and zoom level to center on a specific area, if desired.  Defaults works just fine!
                "latitude" => (float)(getenv("GOOGLE_MAPS_DEFAULT_LATITUDE") ?: 0.0),
                "longitude" => (float)(getenv("GOOGLE_MAPS_DEFAULT_LONGITUDE") ?: 0.0),
                // The higher the zoom number, the closer the view.
                "zoom" => (int)(getenv("GOOGLE_MAPS_DEFAULT_ZOOM") ?: 1),
            ],

        ]
    ],



];
