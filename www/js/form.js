



function locationToggle()
{
    //let $modal = $("#modal");

    //$modal.css("display", "block");




}






function typeChanged(element)
{
    let input = $("#companyNameGroup");

    switch(element.value)
    {
        case "1":
            input.css("display", "none");
            break;

        case "2":
            input.css("display", "block");
            break;

        default:
            break;
    }


}

function updateAddress() {

    let street1 = $("#street1").val();
    let street2 = $("#street2").val();
    let city = $("#city").val();
    let state = $("#state").val();
    let zip = $("#zip").val();
    let country = $("#country").val();

    let $button = $("#geocodeButton");

    let $latitude = $("#latitude");
    let $longitude = $("#longitude");

    if(street1 === "" && street2 === "" && city === "" && state === "" && zip === "" && country === "") {
        $button.addClass("disabled");
        $button.attr("data-target", "");
        $latitude.val("");
        $longitude.val("");
    }
    else {
        $button.removeClass("disabled");
        $button.attr("data-target", "#location");

    }


    street1 = street1.trim().split(" ").join("+");
    street2 = street2.trim().split(" ").join("+");
    city = city.trim().split(" ").join("+");
    state = state.trim().split(" ").join("+");
    zip = zip.trim().split(" ").join("+");
    country = country.trim().split(" ").join("+");

    let address = [ street1, street2, city, state, zip, country ];
    address = address.filter(Boolean);

    let geocode = $("#geocode");

    geocode.val(address.join(","));

}




function updateAgreement(element) {

    // Toggle the "Sign-Up" button when the agreement is accepted.
    if($(element)[0].checked)
        $("#signUpButton").removeClass("disabled");
    else
        $("#signUpButton").addClass("disabled");
}




function submit(button) {

    let $button = $(button);

    if($button.hasClass("disabled"))
        return;

    let $form = $("#signUpForm");

    // Initialize validation of the form, given the form's "name" attribute.
    if($form.valid())
        $form.submit();

}







let map;

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
    map = new google.maps.Map(document.getElementById("map"), {
        center: {lat: lat, lng: lng},
        zoom: zoom
    });


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
                map = new google.maps.Map(document.getElementById("map"), {
                    center: {lat: lat, lng: lng},
                    zoom: 16
                });

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


