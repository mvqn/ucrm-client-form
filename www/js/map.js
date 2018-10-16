


/**
 * Initializes the map instance when used as the Google Maps API callback function.
 */
function initMap() {
    // Get a reference to the "map" element.
    let $map = $("#map")[0];

    // Instantiate a map inside the provided container element.
    let map = new google.maps.Map($map, {
        center: {lat: config.maps.google.defaults.latitude, lng: config.maps.google.defaults.longitude},
        zoom: config.maps.google.defaults.zoom
    });

    // Load any and all layers included in the config, and then zoom to the extents of the layers.
    let layers = loadLayers(map, false);
}



/**
 * Handles loading KML/KMZ layers onto the specified Google Map.
 *
 * @param {google.maps.Map} map The Google Map instance for which to add this layer.
 * @param {Boolean} preserve If TRUE, preserves the current map viewport, FALSE moves/zooms to the layer extents.
 * @returns {Array} Returns an array of the loaded layers for later use.
 */
function loadLayers(map, preserve) {
    // Create an empty array to store the loaded layers.
    let layers = [];

    // Loop through each KML/KMZ URL provided in the config...
    for(let i = 0; i < config.maps.google.layers.length; i++) {
        // Instantiate a layer and assign it to the specified map.
        let layer = new google.maps.KmlLayer({
            url: config.maps.google.layers[i],
            preserveViewport: preserve,
            map: map
        });

        // Add this new layer to the array of loaded layers.
        layers.push(layer);
    }

    // Return the array of loaded layers.
    return layers;
}


/**
 * Handles "geocoding" the address into "latitude" and "longitude" values.
 *
 * @param button The "Geocode" button element.
 */
function geocodeAddress(button) {
    // Get a reference to the "Geocode" button element.
    let $button = $(button);

    // IF the "Geocode" button is disabled, THEN do nothing!
    if($button.hasClass("disabled"))
        return;

    // Set the "idle" and "wait" appearance of the button.
    let idleText = $button.html();
    let waitText = "<i class='fa fa-spinner fa-spin'></i>";

    // Set the "idle" width of the button, to maintain it's size.
    let idleWidth = $button.width();

    // Get the "geocoded" version of the address, as assembled by the updateAddress() function.
    let geocode = $("#geocode").val();

    let url = "https://maps.googleapis.com/maps/api/geocode/json?";
    url += "address=" + geocode;
    url += "&key=" + config.maps.google.api.key;

    // Use a jQuery AJAX request to GET the "geocoded" results...
    $.get(url, function(data)
    {
        // Display the button spinner icon at full width, in case the process is long-running.
        $button.html(waitText);
        $button.width(idleWidth);

        /** @property {Object} data.results */

        // IF valid data was returned...
        if(data.status === "OK" && data.results !== null && data.results.length > 0)
        {
            // THEN get only the first result, even if there is more than one!
            let result = data.results[0];

            // Get the latitude and longitude.
            let lat = Number(result.geometry.location.lat);
            let lng = Number(result.geometry.location.lng);

            // TODO: See if there is an easier way of simply re-centering the map, avoiding a layers reload as well!

            // Center the map on the new lat/lon.
            let map = new google.maps.Map(document.getElementById("map"), {
                center: {lat: lat, lng: lng},
                zoom: 16
            });

            // Reload and display the layers provided in the config.
            let layers = loadLayers(map, true);

            // Set the values of the "Latitude" and "Longitude" input fields.
            $("#latitude").val(lat);
            $("#longitude").val(lng);

            // Instantiate a map pin/marker to represent the geocoded address, and make it draggable.
            let marker = new google.maps.Marker({
                position: { lat: lat, lng: lng },
                map: map,
                title: "Service Location",
                draggable: true
            }).addListener("drag", function(event) {
                $("#latitude").val(event.latLng.lat());
                $("#longitude").val(event.latLng.lng());
            });
        }
    }).done(function(data) {
        // Hide the button spinner icon and restore it's previous content.
        $button.html(idleText);
    });
}

