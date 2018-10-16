







$(function() {



    let script = document.createElement("script");
    script.type = "text/javascript";
    script.src = "https://maps.googleapis.com/maps/api/js?key=" + config.maps.google.api.key + "&callback=refreshMap";
    document.body.appendChild(script);
});