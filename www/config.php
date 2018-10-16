<?php

return
[
    "site" =>
    [
        "name" => "Client Lead Demo",
        "url" => "http://localhost",
    ],

    "ucrm" =>
    [
        "host" => getenv("UCRM_HOST") ?: "http://ucrm.dev.example.com",

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

            "layers" =>
            [
                //"http://ucrm.dev.mvqn.net/Meteorite_Impacts_from_around_the_World.kmz",
                //"http://ucrm.dev.mvqn.net/Wal-Mart_sites.kml"
                //"http://ucrm.dev.mvqn.net/McDonald's_Europe.kml",
                //"http://ucrm.dev.mvqn.net/costco-gas-stations.kml",
                "http://api.flickr.com/services/feeds/geo/?g=322338@N20&lang=en-us&format=feed-georss"
            ],

            "heatmaps" =>
            [
                // Not yet implemented!
            ]
        ]
    ],

    "smtp" =>
    [
        "server" => getenv("SMTP_SERVER") ?: "",
        "sender" =>
            [
                "email" => getenv("SMTP_SENDER_EMAIL") ?: "",
                "name" => getenv("SMTP_SENDER_NAME") ?: "",
            ],
        "username" => getenv("SMTP_USERNAME") ?: "",
        "password" => getenv("SMTP_PASSWORD") ?: "",
        "subject" => getenv("SMTP_SENDER") ?: "New Client Lead",

        "recipients" =>
        [
            "rspaeth@mvqn.net" => "Ryan Spaeth"
        ]
    ],

];
