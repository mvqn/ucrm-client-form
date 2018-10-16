


/**
 * Handles the changes between Residential and Commercial selections.
 *
 * @param {String} value The value of the selected radio button.
 */
function typeChanged(value) {
    // Toggle the "Company Name" input depending on the value.
    $("#companyNameGroup").css("display", value === "2" ? "block" : "none");
}


/**
 * Handles changes to the address fields and toggle the "Locate" button accordingly.
 */
function updateAddress() {

    // Read the values from all of the address input fields.
    let street1 = $("#street1").val();
    let street2 = $("#street2").val();
    let city = $("#city").val();
    let state = $("#state").val();
    let zip = $("#zip").val();
    let country = $("#country").val();

    // Get a reference to the "Locate" button element.
    let $button = $("#locateButton");

    // Get references to the "Latitude" and "Longitude" input fields.
    let $latitude = $("#latitude");
    let $longitude = $("#longitude");

    // IF ANY of the required address fields are empty...
    if(street1 === "" && street2 === "" && city === "" && state === "" && zip === "" && country === "") {
        // THEN disable the "Locate" button and the modal window.
        $button.addClass("disabled");
        $button.attr("data-target", "");

        // AND reset the "Latitude" and "Longitude" input fields.
        $latitude.val("");
        $longitude.val("");
    }
    else {
        // OTHERWISE, there is likely one or more usable lookup fields, so enable the "Locate" button and modal window.
        $button.removeClass("disabled");
        $button.attr("data-target", "#location");
    }

    // Convert the address parts to a "geocode" string, where all spaces are "+" and address parts are separated by ",".
    street1 = street1.trim().split(" ").join("+");
    street2 = street2.trim().split(" ").join("+");
    city = city.trim().split(" ").join("+");
    state = state.trim().split(" ").join("+");
    zip = zip.trim().split(" ").join("+");
    country = country.trim().split(" ").join("+");

    // Remove any null or empty string values from the array of addresses.
    let address = [ street1, street2, city, state, zip, country ].filter(Boolean);

    // Input the "geocode" string into the "geocode" field.
    $("#geocode").val(address.join(","));
}


/**
 * Handles toggling of the "Sign-Up" button, per the state of the "Agreement" checkbox.
 *
 * @param {Boolean} checked the state of the checkbox.
 */
function updateAgreement(checked) {
    // Toggle the "Sign-Up" button when the agreement is accepted.
    if(checked)
        $("#signUpButton").removeClass("disabled");
    else
        $("#signUpButton").addClass("disabled");
}


/**
 * Handles submission of the form if and when it is entirely "valid".
 *
 * @param button The "Sign-Up" button element.
 */
function submit(button) {
    // IF the button is disabled, THEN do nothing!
    if($(button).hasClass("disabled"))
        return;

    // Get a reference to the form element.
    let $form = $("#signUpForm");

    // IF the form is "valid", THEN submit the form!
    if($form.valid())
        $form.submit();
}
