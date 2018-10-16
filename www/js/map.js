





$(function() {
    let script = document.createElement("script");
    script.type = "text/javascript";
    script.src = "https://maps.googleapis.com/maps/api/js?key=" + config.maps.google.api.key + "&callback=refreshMap";
    document.body.appendChild(script);
});










//let map;

function refreshMap(lat, lng, zoom) {

    let $map = $("#map");
    console.log($map);

    // Set default latitude, if the value is not provided...
    if(lat === undefined)
        lat = config.maps.google.defaults.latitude;

    // Set default longitude, if the value is not provided...
    if(lng === undefined)
        lng = config.maps.google.defaults.longitude;

    // Set default zoom factor, if the value is not provided...
    if(zoom === undefined)
        zoom = config.maps.google.defaults.zoom;

    // Instantiate a map inside the provided element.
    let map = new google.maps.Map(document.getElementById("map"), {
        center: {lat: lat, lng: lng},
        zoom: zoom
    });

    let layers = loadLayers(map, false);
}


function loadLayers(map, preserve) {

    let layers = [];

    for(let i = 0; i < config.maps.google.layers.length; i++) {

        let src = config.maps.google.layers[i];

        let layer = new google.maps.KmlLayer(src, {
            preserveViewport: preserve,
            map: map
        });

        layers.push(layer);
    }

    return layers;
}






function geocodeAddress(button)
{
    // Get the button object.
    let $button = $(button);

    if($button.hasClass("disabled"))
        return;

    //$button.attr("data-target", "#modal");


    // Configure the "idle" and "wait" state of the button.
    let idleText = $button.html();
    let idleWidth = $button.width();
    let waitText = "<i class='fa fa-spinner fa-spin'></i>";

    // Get the URL encoded version of the address.
    let geocode = $("#geocode").val();

    //if(geocode)
    {
        let url = "https://maps.googleapis.com/maps/api/geocode/json?";
        url += "address=" + geocode;
        url += "&key=" + config.maps.google.api.key;

        $.get(url, function(data)
        {
            // Show the button spinner icon.
            $button.html(waitText);
            $button.width(idleWidth);

            // IF valid data was returned...
            if(data.status === "OK" && data.results !== null && data.results.length > 0)
            {
                // THEN get the first result, even if there are more than one!
                let result = data.results[0];

                // Get the latitude and longitude.
                let lat = result.geometry.location.lat;
                let lng = result.geometry.location.lng;

                console.log(lat + ", " + lng);

                // Center the mpa on the new lat/lon.
                let map = new google.maps.Map(document.getElementById("map"), {
                    center: {lat: lat, lng: lng},
                    zoom: 16
                });

                let layers = loadLayers(map, true);


                $("#latitude").val(lat);
                $("#longitude").val(lng);

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
            // Hide the button spinner icon and restore it's previous text.
            $button.html(idleText);
        });



    }

}

