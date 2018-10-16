



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






