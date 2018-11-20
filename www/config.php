<?php
/**
 *
 *
 * @author Ryan Spaeth <rspaeth@mvqn.net>
 */

return
[

    "site" =>
    [
        "demo" =>               true,

        "name" =>               "Client Lead Demo",

                                // The return URL to display to the customer after submission.
        "url" =>                "http://dev.mvqn.net",

        "lang" =>               "en-US"
    ],


    "ucrm" =>                   // UCRM: This section MUST be completed for the forms to work!
    [
        "host" =>               getenv("UCRM_HOST") ?:
                                // Configure your host url here, as it appears while logged into the UCRM system.
                                "http://ucrm.dev.example.com"
        ,
        "rest" =>
        [
            "url" =>            getenv("UCRM_REST_URL") ?:
                                // The REST Client does not currently support HTTPS for the API calls.
                                "http://ucrm.dev.example.com/api/v1.0"
            ,
            "key" =>            getenv("UCRM_REST_KEY") ?:
                                // Be sure the App Key you generate in the UCRM is of type "Write" or the Client Lead
                                // generation will fail!
                                ""
            ,
        ],
    ],

    "maps" =>                   // MAPS: This section MUST be completed for the forms to work!
    [
        "google" =>             // Only Google Maps is currently supported!
        [
            "api" =>
            [
                "key" =>        getenv("GOOGLE_MAPS_API_KEY") ?:
                                // You should be able use the same key that you are currently using in UCRM or UNMS.
                                ""
                ,
            ],

            "defaults" =>
            [
                "latitude" =>   (float)(getenv("GOOGLE_MAPS_DEFAULT_LATITUDE") ?:
                                // Set a default Latitude to center on a specific area, if desired.
                                0.0
                ),

                "longitude" =>  (float)(getenv("GOOGLE_MAPS_DEFAULT_LONGITUDE") ?:
                                // Set a default Longitude to center on a specific area, if desired.
                                0.0
                ),

                "zoom" =>       (int)(getenv("GOOGLE_MAPS_DEFAULT_ZOOM") ?:
                                // Set a default Zoom level, if desired.  The higher the number, the closer the view.
                                1
                ),
            ],

            "layers" =>         // A list of KML/KMZ files that should be drawn on the map as overlays...
            [
                                //"http://ucrm.dev.mvqn.net/Meteorite_Impacts_from_around_the_World.kmz",
                                //"http://ucrm.dev.mvqn.net/Wal-Mart_sites.kml"
                                //"http://ucrm.dev.mvqn.net/McDonald's_Europe.kml",
                                //"http://ucrm.dev.mvqn.net/costco-gas-stations.kml",
                                "http://api.flickr.com/services/feeds/geo/?g=322338@N20&lang=en-us&format=feed-georss"
            ],

            "heatmaps" =>       // Not yet implemented!
            [

            ]
        ]
    ],

];
